<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleContract;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\CategoryContract;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;
use JeffersonGoncalves\KnowledgeBase\Support\Visibility;

/**
 * The Guest and User panels' public-only queries.
 *
 * When the installed core has the public visibility scopes (#15,
 * {@see Visibility}), every query goes through them, so a public article in an
 * internal category or under an internal/inactive ancestor is hidden from
 * customers, exactly like the core's own public surfaces. With an older core the
 * previous queries (which only filtered on the article's or category's own
 * columns) are kept, so the plugin still works there.
 */
class PublicVisibility
{
    /**
     * Whether the installed core ships the public visibility scopes.
     */
    public static function isSupported(): bool
    {
        return class_exists(Visibility::class);
    }

    /**
     * Restrict an article query to the articles customers may see.
     *
     * @template TModel of Model
     *
     * @param  Builder<TModel>  $query
     * @return Builder<TModel>
     */
    public static function scopeArticles(Builder $query): Builder
    {
        if (static::isSupported()) {
            return Visibility::applyPublic($query);
        }

        return $query
            ->where($query->qualifyColumn('status'), ArticleStatus::Published->value)
            ->where($query->qualifyColumn('visibility'), ArticleVisibility::Public->value);
    }

    /**
     * Restrict a category query to the categories customers may see.
     *
     * @template TModel of Model
     *
     * @param  Builder<TModel>  $query
     * @return Builder<TModel>
     */
    public static function scopeCategories(Builder $query): Builder
    {
        if (static::isSupported()) {
            return $query->whereIn($query->qualifyColumn('id'), Visibility::publicCategoryIds());
        }

        return $query
            ->where($query->qualifyColumn('is_active'), true)
            ->where($query->qualifyColumn('visibility'), ArticleVisibility::Public->value);
    }

    /**
     * The publicly visible articles, most viewed first (the popular-articles
     * widget's query).
     *
     * @return Builder<Model&ArticleContract>
     */
    public static function popularArticlesQuery(int $limit = 5): Builder
    {
        $articleClass = ModelResolver::article();

        return static::scopeArticles($articleClass::query()->orderByDesc('view_count'))->limit($limit);
    }

    /**
     * The root categories a customer sees, with their number of publicly
     * visible articles (the knowledge-base page's category menu).
     *
     * @return Collection<int, Model&CategoryContract>
     */
    public static function rootCategories(): Collection
    {
        $categoryClass = ModelResolver::category();

        $query = $categoryClass::query()
            ->whereNull('parent_id')
            ->withCount(['articles' => fn (Builder $articles): Builder => static::scopeArticles($articles)])
            ->orderBy('sort_order');

        return static::scopeCategories($query)->get();
    }
}
