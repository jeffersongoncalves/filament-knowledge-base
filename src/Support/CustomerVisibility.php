<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Support;

use BackedEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;

/**
 * Why a customer cannot see an article right now, for the collections admin's
 * "customers cannot see this article" warning (spec: collections-admin).
 *
 * A collection may hold any article, public or not: an internal article can sit
 * in it while it is being prepared. The editor is warned with the reason instead
 * of being blocked, because visibility (and the category's) can change later and
 * the public read filters at read time anyway.
 */
class CustomerVisibility
{
    public const NOT_PUBLISHED = 'not_published';

    public const INTERNAL_ARTICLE = 'internal_article';

    public const INTERNAL_CATEGORY = 'internal_category';

    public const INACTIVE_CATEGORY = 'inactive_category';

    public const DELETED_CATEGORY = 'deleted_category';

    public const BROKEN_TREE = 'broken_category_tree';

    /**
     * The reason an article is not customer-visible, or null when it is.
     */
    public static function reason(Model $article): ?string
    {
        if (static::value($article->getAttribute('status')) !== ArticleStatus::Published->value) {
            return self::NOT_PUBLISHED;
        }

        if (static::value($article->getAttribute('visibility')) !== ArticleVisibility::Public->value) {
            return self::INTERNAL_ARTICLE;
        }

        return static::categoryReason($article->getAttribute('category_id'));
    }

    public static function isVisible(Model $article): bool
    {
        return static::reason($article) === null;
    }

    public static function label(string $reason): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.collections.warnings.'.$reason);
    }

    /**
     * The warning sentence for an article id, or null when there is nothing to
     * warn about.
     */
    public static function warningFor(int|string|null $articleId): ?string
    {
        if ($articleId === null || $articleId === '') {
            return null;
        }

        $articleClass = ModelResolver::article();
        $article = $articleClass::query()->find($articleId);

        if (! $article instanceof Model) {
            return null;
        }

        $reason = static::reason($article);

        return $reason === null ? null : static::label($reason);
    }

    /**
     * Walk the category chain and report the first category that hides it.
     */
    protected static function categoryReason(int|string|null $categoryId): ?string
    {
        $categoryClass = ModelResolver::category();
        $usesSoftDeletes = in_array(SoftDeletes::class, class_uses_recursive($categoryClass), true);
        $seen = [];

        while ($categoryId !== null) {
            if (isset($seen[$categoryId])) {
                return self::BROKEN_TREE;
            }

            $seen[$categoryId] = true;

            $query = $categoryClass::query();

            if ($usesSoftDeletes) {
                // @phpstan-ignore method.notFound (withTrashed() is provided by the SoftDeletes trait)
                $query->withTrashed();
            }

            $category = $query->find($categoryId);

            if (! $category instanceof Model) {
                return self::BROKEN_TREE;
            }

            if ($usesSoftDeletes && (bool) $category->getAttribute('deleted_at')) {
                return self::DELETED_CATEGORY;
            }

            if (static::value($category->getAttribute('visibility')) !== ArticleVisibility::Public->value) {
                return self::INTERNAL_CATEGORY;
            }

            if (! (bool) $category->getAttribute('is_active')) {
                return self::INACTIVE_CATEGORY;
            }

            $categoryId = $category->getAttribute('parent_id');
        }

        return null;
    }

    protected static function value(mixed $attribute): ?string
    {
        if ($attribute instanceof BackedEnum) {
            return (string) $attribute->value;
        }

        return $attribute === null ? null : (string) $attribute;
    }
}
