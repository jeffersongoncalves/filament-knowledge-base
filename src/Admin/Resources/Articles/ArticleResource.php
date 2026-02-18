<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Schemas\ArticleForm;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Schemas\ArticleInfolist;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Tables\ArticlesTable;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBasePlugin;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
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

    public static function form(Schema $schema): Schema
    {
        return ArticleForm::configure($schema);
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

    public static function hasSeo(): bool
    {
        try {
            return KnowledgeBasePlugin::get()->hasSeo();
        } catch (\Throwable) {
            return config('filament-knowledge-base.features.seo', true);
        }
    }
}
