<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources;

use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\ArticleResource\Pages;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBaseGuestPlugin;
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
            return KnowledgeBaseGuestPlugin::get()->getNavigationGroup()
                ?? config('filament-knowledge-base.navigation.guest.group', 'Knowledge Base');
        } catch (\Throwable) {
            return config('filament-knowledge-base.navigation.guest.group', 'Knowledge Base');
        }
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.guest.articles.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.plural_model_label');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.category'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.published_at'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('view_count')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.view_count'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                        Infolists\Components\TextEntry::make('title')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.title'))
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('category.name')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.category'))
                            ->badge(),
                        Infolists\Components\TextEntry::make('published_at')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.published_at'))
                            ->dateTime(),
                        Infolists\Components\TextEntry::make('view_count')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.view_count')),
                    ])->columns(3),
                Infolists\Components\Section::make()
                    ->schema([
                        Infolists\Components\TextEntry::make('excerpt')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.excerpt'))
                            ->columnSpanFull()
                            ->visible(fn ($record) => filled($record->excerpt)),
                        Infolists\Components\TextEntry::make('content')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.content'))
                            ->html()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'view' => Pages\ViewArticle::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('status', ArticleStatus::Published->value)
            ->where('visibility', ArticleVisibility::Public->value);
    }
}
