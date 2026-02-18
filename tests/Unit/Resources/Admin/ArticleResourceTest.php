<?php

use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource;
use JeffersonGoncalves\KnowledgeBase\Models\Article;

it('resolves the correct model', function () {
    expect(ArticleResource::getModel())->toBe(Article::class);
});

it('has navigation label', function () {
    expect(ArticleResource::getNavigationLabel())->toBeString();
});

it('has model label', function () {
    expect(ArticleResource::getModelLabel())->toBeString();
});

it('has plural model label', function () {
    expect(ArticleResource::getPluralModelLabel())->toBeString();
});

it('has pages defined', function () {
    $pages = ArticleResource::getPages();

    expect($pages)->toBeArray()
        ->toHaveKeys(['index', 'create', 'view', 'edit']);
});

it('has conditional relation managers', function () {
    $relations = ArticleResource::getRelations();

    expect($relations)->toBeArray();
});

it('has relation managers when features enabled', function () {
    config(['filament-knowledge-base.features.versioning' => true]);
    config(['filament-knowledge-base.features.feedback' => true]);
    config(['filament-knowledge-base.features.related_articles' => true]);

    $relations = ArticleResource::getRelations();

    expect($relations)->toHaveCount(3);
});

it('has no relation managers when features disabled', function () {
    config(['filament-knowledge-base.features.versioning' => false]);
    config(['filament-knowledge-base.features.feedback' => false]);
    config(['filament-knowledge-base.features.related_articles' => false]);

    $relations = ArticleResource::getRelations();

    expect($relations)->toHaveCount(0);
});

it('has seo feature check', function () {
    config(['filament-knowledge-base.features.seo' => true]);
    expect(ArticleResource::hasSeo())->toBeTrue();

    config(['filament-knowledge-base.features.seo' => false]);
    expect(ArticleResource::hasSeo())->toBeFalse();
});

it('reads navigation group from config', function () {
    config(['filament-knowledge-base.navigation.admin.group' => 'Custom KB']);

    expect(ArticleResource::getNavigationGroup())->toBe('Custom KB');
});
