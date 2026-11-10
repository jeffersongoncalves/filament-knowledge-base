<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Support;

use BackedEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;
use JeffersonGoncalves\KnowledgeBase\Support\Visibility;

/**
 * Why a customer cannot see an article right now, for the collections admin's
 * "customers cannot see this article" warning (spec: collections-admin).
 *
 * A collection may hold any article, public or not: an internal article can sit
 * in it while it is being prepared. The editor is warned with the reason instead
 * of being blocked, because visibility (and the category's) can change later and
 * the public read filters at read time anyway.
 *
 * Whether an article is visible is decided by the core's rule
 * ({@see Visibility::articleIsPubliclyVisible()}), the same one every public
 * read uses, so the warning can never disagree with what customers see. This
 * class only explains why, and falls back to a generic reason if the core ever
 * hides an article for a reason it does not know.
 */
class CustomerVisibility
{
    public const NOT_PUBLISHED = 'not_published';

    public const INTERNAL_ARTICLE = 'internal_article';

    public const INTERNAL_CATEGORY = 'internal_category';

    public const INACTIVE_CATEGORY = 'inactive_category';

    public const DELETED_CATEGORY = 'deleted_category';

    public const BROKEN_TREE = 'broken_category_tree';

    public const NOT_VISIBLE = 'not_visible';

    /** Visible, but only to signed-in customers: the article is `customers`. */
    public const CUSTOMERS_ARTICLE = 'customers_article';

    /** Visible, but only to signed-in customers: a category in its chain is `customers`. */
    public const CUSTOMERS_CATEGORY = 'customers_category';

    /**
     * The reason an article is not customer-visible, or null when it is.
     */
    public static function reason(Model $article): ?string
    {
        if (Visibility::articleIsPubliclyVisible($article)) {
            return null;
        }

        return static::explain($article) ?? self::NOT_VISIBLE;
    }

    /**
     * The first rule the article fails, in the order an editor would fix them.
     * A reason that hides it from everyone wins over "signed-in customers
     * only", which still leaves it readable in the User panel.
     */
    protected static function explain(Model $article): ?string
    {
        if (static::value($article->getAttribute('status')) !== ArticleStatus::Published->value) {
            return self::NOT_PUBLISHED;
        }

        $visibility = static::value($article->getAttribute('visibility'));

        if ($visibility !== ArticleVisibility::Public->value && $visibility !== ArticleVisibility::Customers->value) {
            return self::INTERNAL_ARTICLE;
        }

        $categoryReason = static::categoryReason($article->getAttribute('category_id'));

        if ($categoryReason !== null && $categoryReason !== self::CUSTOMERS_CATEGORY) {
            return $categoryReason;
        }

        return $visibility === ArticleVisibility::Customers->value ? self::CUSTOMERS_ARTICLE : $categoryReason;
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
        $customersOnly = false;

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

            $visibility = static::value($category->getAttribute('visibility'));

            if ($visibility === ArticleVisibility::Customers->value) {
                $customersOnly = true;
            } elseif ($visibility !== ArticleVisibility::Public->value) {
                return self::INTERNAL_CATEGORY;
            }

            if (! (bool) $category->getAttribute('is_active')) {
                return self::INACTIVE_CATEGORY;
            }

            $categoryId = $category->getAttribute('parent_id');
        }

        return $customersOnly ? self::CUSTOMERS_CATEGORY : null;
    }

    protected static function value(mixed $attribute): ?string
    {
        if ($attribute instanceof BackedEnum) {
            return (string) $attribute->value;
        }

        return $attribute === null ? null : (string) $attribute;
    }
}
