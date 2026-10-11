<?php

use JeffersonGoncalves\FilamentKnowledgeBase\Support\CustomerVisibility;
use JeffersonGoncalves\KnowledgeBase\Models\Article;
use JeffersonGoncalves\KnowledgeBase\Models\Category;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use JeffersonGoncalves\KnowledgeBase\Support\Visibility;

/**
 * The reason helper behind the collections admin's "customers cannot see this"
 * warning (spec: Choosing and ordering articles).
 */
beforeEach(function () {
    $this->service = app(KnowledgeBaseService::class);
});

function visibilityArticle(Category $category, array $overrides = []): Article
{
    return new Article(array_merge([
        'category_id' => $category->id,
        'status' => 'published',
        'visibility' => 'public',
    ], $overrides));
}

it('reports nothing for a public published article in a public category', function () {
    $category = $this->service->createCategory(['name' => 'Public', 'slug' => 'public']);
    $article = visibilityArticle($category);

    expect(CustomerVisibility::reason($article))->toBeNull()
        ->and(CustomerVisibility::isVisible($article))->toBeTrue();
});

it('reports an unpublished article', function () {
    $category = $this->service->createCategory(['name' => 'Public', 'slug' => 'public']);
    $article = visibilityArticle($category, ['status' => 'draft']);

    expect(CustomerVisibility::reason($article))->toBe(CustomerVisibility::NOT_PUBLISHED);
});

it('reports an internal article', function () {
    $category = $this->service->createCategory(['name' => 'Public', 'slug' => 'public']);
    $article = visibilityArticle($category, ['visibility' => 'internal']);

    expect(CustomerVisibility::reason($article))->toBe(CustomerVisibility::INTERNAL_ARTICLE);
});

it('reports an internal category', function () {
    $category = $this->service->createCategory(['name' => 'Internal', 'slug' => 'internal', 'visibility' => 'internal']);
    $article = visibilityArticle($category);

    expect(CustomerVisibility::reason($article))->toBe(CustomerVisibility::INTERNAL_CATEGORY);
});

it('reports an inactive category', function () {
    $category = $this->service->createCategory(['name' => 'Archive', 'slug' => 'archive', 'is_active' => false]);
    $article = visibilityArticle($category);

    expect(CustomerVisibility::reason($article))->toBe(CustomerVisibility::INACTIVE_CATEGORY);
});

it('reports an internal ancestor category', function () {
    $internal = $this->service->createCategory(['name' => 'Internal', 'slug' => 'internal', 'visibility' => 'internal']);
    $child = $this->service->createCategory(['name' => 'Child', 'slug' => 'child', 'parent_id' => $internal->id]);
    $article = visibilityArticle($child);

    expect(CustomerVisibility::reason($article))->toBe(CustomerVisibility::INTERNAL_CATEGORY);
});

it('translates a reason into a warning sentence', function () {
    expect(CustomerVisibility::label(CustomerVisibility::INTERNAL_CATEGORY))
        ->toBe(__('filament-knowledge-base::knowledge-base.admin.collections.warnings.internal_category'))
        ->and(CustomerVisibility::warningFor(null))->toBeNull();
});

it('takes the visible-or-not decision from the core rule', function () {
    $public = $this->service->createCategory(['name' => 'Public', 'slug' => 'public']);
    $internal = $this->service->createCategory(['name' => 'Internal', 'slug' => 'internal', 'visibility' => 'internal']);
    $inactive = $this->service->createCategory(['name' => 'Inactive', 'slug' => 'inactive', 'is_active' => false]);
    $under = $this->service->createCategory(['name' => 'Under', 'slug' => 'under', 'parent_id' => $internal->id]);

    $cases = [
        visibilityArticle($public),
        visibilityArticle($public, ['visibility' => 'internal']),
        visibilityArticle($public, ['status' => 'draft']),
        visibilityArticle($internal),
        visibilityArticle($inactive),
        visibilityArticle($under),
    ];

    foreach ($cases as $article) {
        expect(CustomerVisibility::isVisible($article))
            ->toBe(Visibility::articleIsPubliclyVisible($article));
    }
});
