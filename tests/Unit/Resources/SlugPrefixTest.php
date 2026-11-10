<?php

use Filament\Facades\Filament;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\ArticleResource as AdminArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\CategoryResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\CollectionResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\Articles\ArticleResource as GuestArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\Articles\ArticleResource as UserArticleResource;

it('keeps Filament\'s default slugs without a prefix', function () {
    expect(CategoryResource::getSlug())->toBe('categories')
        ->and(AdminArticleResource::getSlug())->toBe('articles')
        ->and(CollectionResource::getSlug())->toBe('collections');
});

it('prefixes the slug of every resource', function (string $resource, string $slug) {
    config(['filament-knowledge-base.slug_prefix' => 'knowledge-base']);

    expect($resource::getSlug())->toBe("knowledge-base/{$slug}");
})->with([
    'admin categories' => [CategoryResource::class, 'categories'],
    'admin articles' => [AdminArticleResource::class, 'articles'],
    'admin collections' => [CollectionResource::class, 'collections'],
    'user articles' => [UserArticleResource::class, 'articles'],
    'guest articles' => [GuestArticleResource::class, 'articles'],
]);

it('ignores slashes around the prefix', function () {
    config(['filament-knowledge-base.slug_prefix' => '/kb/']);

    expect(CategoryResource::getSlug())->toBe('kb/categories');
});

it('gives the prefixed resource its own route names', function () {
    config(['filament-knowledge-base.slug_prefix' => 'knowledge-base']);

    expect(CategoryResource::getRouteBaseName(Filament::getPanel('admin')))
        ->toBe('filament.admin.resources.knowledge-base.categories');
});
