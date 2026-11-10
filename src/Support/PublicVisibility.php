<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleContract;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\CategoryContract;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;
use JeffersonGoncalves\KnowledgeBase\Support\Visibility;

/**
 * The Guest and User panels' reader queries.
 *
 * Every query goes through the core's visibility rules ({@see Visibility}) for
 * an audience, so an article in a category the audience may not read, or under
 * an inactive ancestor, is hidden exactly like on the core's own surfaces. The
 * Guest panel reads as the public; the User panel as signed-in customers, who
 * also see `customers` content.
 */
class PublicVisibility
{
    /**
     * Restrict an article query to the articles the audience may see.
     *
     * @template TModel of Model
     *
     * @param  Builder<TModel>  $query
     * @return Builder<TModel>
     */
    public static function scopeArticles(Builder $query, ArticleVisibility $audience = ArticleVisibility::Public): Builder
    {
        return Visibility::applyFor($query, $audience);
    }

    /**
     * Restrict a category query to the categories the audience may see.
     *
     * @template TModel of Model
     *
     * @param  Builder<TModel>  $query
     * @return Builder<TModel>
     */
    public static function scopeCategories(Builder $query, ArticleVisibility $audience = ArticleVisibility::Public): Builder
    {
        return $query->whereIn($query->qualifyColumn('id'), Visibility::categoryIdsFor($audience));
    }

    /**
     * The articles the audience may see, most viewed first (the
     * popular-articles widget's query).
     *
     * @return Builder<Model&ArticleContract>
     */
    public static function popularArticlesQuery(int $limit = 5, ArticleVisibility $audience = ArticleVisibility::Public): Builder
    {
        $articleClass = ModelResolver::article();

        return static::scopeArticles($articleClass::query()->orderByDesc('view_count'), $audience)->limit($limit);
    }

    /**
     * The root categories the audience sees, with their number of articles it
     * may read (the knowledge-base page's category menu).
     *
     * @return Collection<int, Model&CategoryContract>
     */
    public static function rootCategories(ArticleVisibility $audience = ArticleVisibility::Public): Collection
    {
        $categoryClass = ModelResolver::category();

        $query = $categoryClass::query()
            ->whereNull('parent_id')
            ->withCount(['articles' => fn (Builder $articles): Builder => static::scopeArticles($articles, $audience)])
            ->orderBy('sort_order');

        return static::scopeCategories($query, $audience)->get();
    }
}
