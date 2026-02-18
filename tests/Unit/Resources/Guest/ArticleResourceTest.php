<?php

use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\Articles\ArticleResource;
use JeffersonGoncalves\KnowledgeBase\Models\Article;

it('resolves the correct model', function () {
    expect(ArticleResource::getModel())->toBe(Article::class);
});

it('cannot create articles', function () {
    expect(ArticleResource::canCreate())->toBeFalse();
});

it('has pages defined', function () {
    $pages = ArticleResource::getPages();

    expect($pages)->toBeArray()
        ->toHaveKeys(['index', 'view']);
});

it('does not have create or edit pages', function () {
    $pages = ArticleResource::getPages();

    expect($pages)->not->toHaveKey('create')
        ->not->toHaveKey('edit');
});

it('has no relation managers', function () {
    $relations = ArticleResource::getRelations();

    expect($relations)->toBeArray()->toBeEmpty();
});

it('reads navigation group from config', function () {
    config(['filament-knowledge-base.navigation.guest.group' => 'Public KB']);

    expect(ArticleResource::getNavigationGroup())->toBe('Public KB');
});
