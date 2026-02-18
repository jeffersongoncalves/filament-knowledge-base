<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CategoryResource\Pages;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBasePlugin;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;

class CategoryResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?int $navigationSort = 1;

    public static function getModel(): string
    {
        return ModelResolver::category();
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
        return __('filament-knowledge-base::knowledge-base.admin.categories.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.categories.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.categories.plural_model_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.categories.form.section_details'))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.name'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                                if ($state) {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        Forms\Components\TextInput::make('slug')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.slug'))
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('parent_id')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.parent'))
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Forms\Components\Textarea::make('description')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.description'))
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
                Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.categories.form.section_settings'))
                    ->schema([
                        Forms\Components\TextInput::make('icon')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.icon'))
                            ->placeholder('heroicon-o-folder')
                            ->maxLength(255),
                        Forms\Components\Select::make('visibility')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.visibility'))
                            ->options([
                                'public' => __('filament-knowledge-base::knowledge-base.common.visibility.public'),
                                'internal' => __('filament-knowledge-base::knowledge-base.common.visibility.internal'),
                            ])
                            ->default('public')
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.is_active'))
                            ->default(true),
                        Forms\Components\TextInput::make('sort_order')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.sort_order'))
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('parent.name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.parent'))
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('articles_count')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.articles_count'))
                    ->counts('articles')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.is_active'))
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.sort_order'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.visibility'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'public' => 'success',
                        'internal' => 'warning',
                        default => 'gray',
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.is_active')),
                Tables\Filters\SelectFilter::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.visibility'))
                    ->options([
                        'public' => __('filament-knowledge-base::knowledge-base.common.visibility.public'),
                        'internal' => __('filament-knowledge-base::knowledge-base.common.visibility.internal'),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
