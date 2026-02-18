<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\Articles;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBaseUserPlugin;
use JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\Articles\Pages;
use JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\Articles\Schemas\ArticleInfolist;
use JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\Articles\Tables\ArticlesTable;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;

class ArticleResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?int $navigationSort = 0;

    public static function getModel(): string
    {
        return ModelResolver::article();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return KnowledgeBaseUserPlugin::get()->getNavigationGroup()
                ?? config('filament-knowledge-base.navigation.user.group', 'Knowledge Base');
        } catch (\Throwable) {
            return config('filament-knowledge-base.navigation.user.group', 'Knowledge Base');
        }
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.user.articles.navigation_label');
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
        return ArticlesTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ArticleInfolist::configure($schema);
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
