<?php

use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CategoryResource;
use JeffersonGoncalves\KnowledgeBase\Models\Category;

it('resolves the correct model', function () {
    expect(CategoryResource::getModel())->toBe(Category::class);
});

it('has navigation label', function () {
    expect(CategoryResource::getNavigationLabel())->toBeString();
});

it('has model label', function () {
    expect(CategoryResource::getModelLabel())->toBeString();
});

it('has plural model label', function () {
    expect(CategoryResource::getPluralModelLabel())->toBeString();
});

it('has pages defined', function () {
    $pages = CategoryResource::getPages();

    expect($pages)->toBeArray()
        ->toHaveKeys(['index', 'create', 'edit']);
});

it('has no relation managers', function () {
    $relations = CategoryResource::getRelations();

    expect($relations)->toBeArray()->toBeEmpty();
});

it('reads navigation group from config', function () {
    config(['filament-knowledge-base.navigation.admin.group' => 'Custom KB']);

    expect(CategoryResource::getNavigationGroup())->toBe('Custom KB');
});
