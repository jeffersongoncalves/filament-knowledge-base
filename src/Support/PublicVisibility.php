<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleContract;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\CategoryContract;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;
use JeffersonGoncalves\KnowledgeBase\Support\Visibility;

/**
 * The Guest and User panels' public-only queries.
 *
 * Every query goes through the core's public visibility rules
 * ({@see Visibility}), so a public article in an internal category or under an
 * internal/inactive ancestor is hidden from customers, exactly like the core's
 * own public surfaces.
 */
class PublicVisibility
{
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
        return Visibility::applyPublic($query);
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
        return $query->whereIn($query->qualifyColumn('id'), Visibility::publicCategoryIds());
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
