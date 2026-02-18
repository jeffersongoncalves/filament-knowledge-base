<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\Pages;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\RelationManagers;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBasePlugin;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;

class ArticleResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 0;

    public static function getModel(): string
    {
        return ModelResolver::article();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return KnowledgeBasePlugin::get()->getNavigationGroup()
                ?? config('filament-knowledge-base.navigation.admin.group', 'Knowledge Base');
        } catch (\Throwable) {
            return config('filament-knowledge-base.navigation.admin.group', 'Knowledge Base');
        }
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.plural_model_label');
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getEloquentQuery()
            ->where('status', ArticleStatus::Draft->value)
            ->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        $schema = [
            Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_content'))
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.title'))
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                            if ($state) {
                                $set('slug', Str::slug($state));
                            }
                        }),
                    Forms\Components\TextInput::make('slug')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.slug'))
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),
                    Forms\Components\Select::make('category_id')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.category'))
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\RichEditor::make('content')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.content'))
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('excerpt')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.excerpt'))
                        ->rows(3)
                        ->columnSpanFull(),
                ])->columns(2),

            Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_settings'))
                ->schema([
                    Forms\Components\Select::make('status')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.status'))
                        ->options(collect(ArticleStatus::cases())->mapWithKeys(fn (ArticleStatus $status) => [
                            $status->value => $status->label(),
                        ]))
                        ->default(ArticleStatus::Draft->value)
                        ->required(),
                    Forms\Components\Select::make('visibility')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.visibility'))
                        ->options(collect(ArticleVisibility::cases())->mapWithKeys(fn (ArticleVisibility $visibility) => [
                            $visibility->value => $visibility->label(),
                        ]))
                        ->default(ArticleVisibility::Public->value)
                        ->required(),
                    Forms\Components\DateTimePicker::make('published_at')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.published_at')),
                ])->columns(2),
        ];

        if (static::hasSeo()) {
            $schema[] = Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_seo'))
                ->schema([
                    Forms\Components\TextInput::make('seo_title')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_title'))
                        ->maxLength(255),
                    Forms\Components\Textarea::make('seo_description')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_description'))
                        ->rows(2),
                    Forms\Components\TextInput::make('seo_keywords')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_keywords'))
                        ->maxLength(255),
                ])->columns(2)
                ->collapsible()
                ->collapsed();
        }

        return $form->schema($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.title'))
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.category'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        ArticleStatus::Draft->value => 'gray',
                        ArticleStatus::Published->value => 'success',
                        ArticleStatus::Archived->value => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ArticleStatus::from($state)->label()),
                Tables\Columns\TextColumn::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.visibility'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        ArticleVisibility::Public->value => 'success',
                        ArticleVisibility::Internal->value => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ArticleVisibility::from($state)->label())
                    ->toggleable(),
                Tables\Columns\TextColumn::make('view_count')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.view_count'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.published_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.status'))
                    ->options(collect(ArticleStatus::cases())->mapWithKeys(fn (ArticleStatus $status) => [
                        $status->value => $status->label(),
                    ])),
                Tables\Filters\SelectFilter::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.visibility'))
                    ->options(collect(ArticleVisibility::cases())->mapWithKeys(fn (ArticleVisibility $visibility) => [
                        $visibility->value => $visibility->label(),
                    ])),
                Tables\Filters\SelectFilter::make('category_id')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.category'))
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        $schema = [
            Infolists\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_content'))
                ->schema([
                    Infolists\Components\TextEntry::make('title')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.title')),
                    Infolists\Components\TextEntry::make('slug')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.slug')),
                    Infolists\Components\TextEntry::make('category.name')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.category')),
                    Infolists\Components\TextEntry::make('content')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.content'))
                        ->html()
                        ->columnSpanFull(),
                    Infolists\Components\TextEntry::make('excerpt')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.excerpt'))
                        ->columnSpanFull(),
                ])->columns(2),

            Infolists\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_settings'))
                ->schema([
                    Infolists\Components\TextEntry::make('status')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.status'))
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            ArticleStatus::Draft->value => 'gray',
                            ArticleStatus::Published->value => 'success',
                            ArticleStatus::Archived->value => 'danger',
                            default => 'gray',
                        }),
                    Infolists\Components\TextEntry::make('visibility')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.visibility'))
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'public' => 'success',
                            'internal' => 'warning',
                            default => 'gray',
                        }),
                    Infolists\Components\TextEntry::make('published_at')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.published_at'))
                        ->dateTime(),
                    Infolists\Components\TextEntry::make('view_count')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.view_count')),
                    Infolists\Components\TextEntry::make('helpful_count')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.infolist.helpful_count')),
                    Infolists\Components\TextEntry::make('not_helpful_count')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.infolist.not_helpful_count')),
                    Infolists\Components\TextEntry::make('current_version')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.infolist.current_version')),
                    Infolists\Components\TextEntry::make('created_at')
                        ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                        ->dateTime(),
                    Infolists\Components\TextEntry::make('updated_at')
                        ->label(__('filament-knowledge-base::knowledge-base.common.updated_at'))
                        ->dateTime(),
                ])->columns(3),
        ];

        if (static::hasSeo()) {
            $schema[] = Infolists\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_seo'))
                ->schema([
                    Infolists\Components\TextEntry::make('seo_title')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_title')),
                    Infolists\Components\TextEntry::make('seo_description')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_description')),
                    Infolists\Components\TextEntry::make('seo_keywords')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_keywords')),
                ])->columns(3)
                ->collapsible()
                ->collapsed();
        }

        return $infolist->schema($schema);
    }

    public static function getRelations(): array
    {
        $relations = [];

        try {
            $plugin = KnowledgeBasePlugin::get();

            if ($plugin->hasVersioning()) {
                $relations[] = RelationManagers\VersionsRelationManager::class;
            }

            if ($plugin->hasFeedback()) {
                $relations[] = RelationManagers\FeedbackRelationManager::class;
            }

            if ($plugin->hasRelatedArticles()) {
                $relations[] = RelationManagers\RelatedArticlesRelationManager::class;
            }
        } catch (\Throwable) {
            if (config('filament-knowledge-base.features.versioning', true)) {
                $relations[] = RelationManagers\VersionsRelationManager::class;
            }

            if (config('filament-knowledge-base.features.feedback', true)) {
                $relations[] = RelationManagers\FeedbackRelationManager::class;
            }

            if (config('filament-knowledge-base.features.related_articles', true)) {
                $relations[] = RelationManagers\RelatedArticlesRelationManager::class;
            }
        }

        return $relations;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    protected static function hasSeo(): bool
    {
        try {
            return KnowledgeBasePlugin::get()->hasSeo();
        } catch (\Throwable) {
            return config('filament-knowledge-base.features.seo', true);
        }
    }
}
