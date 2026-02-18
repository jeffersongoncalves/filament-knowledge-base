<?php

it('loads the filament-knowledge-base config', function () {
    expect(config('filament-knowledge-base'))->toBeArray();
});

it('has navigation config for admin', function () {
    expect(config('filament-knowledge-base.navigation.admin'))->toBeArray()
        ->toHaveKeys(['group', 'sort', 'icon']);
});

it('has navigation config for user', function () {
    expect(config('filament-knowledge-base.navigation.user'))->toBeArray()
        ->toHaveKeys(['group', 'sort', 'icon']);
});

it('has navigation config for guest', function () {
    expect(config('filament-knowledge-base.navigation.guest'))->toBeArray()
        ->toHaveKeys(['group', 'sort', 'icon']);
});

it('has features config', function () {
    expect(config('filament-knowledge-base.features'))->toBeArray()
        ->toHaveKeys(['versioning', 'feedback', 'related_articles', 'seo']);
});

it('has correct default feature values', function () {
    expect(config('filament-knowledge-base.features.versioning'))->toBeTrue()
        ->and(config('filament-knowledge-base.features.feedback'))->toBeTrue()
        ->and(config('filament-knowledge-base.features.related_articles'))->toBeTrue()
        ->and(config('filament-knowledge-base.features.seo'))->toBeTrue();
});
