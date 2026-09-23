<?php

use JeffersonGoncalves\FilamentKnowledgeBase\FilamentKnowledgeBaseServiceProvider;

it('registers the filament-knowledge-base config', function () {
    expect(config('filament-knowledge-base'))->toBeArray();
});

it('publishes config with correct tag', function () {
    $serviceProvider = app()->getProvider(FilamentKnowledgeBaseServiceProvider::class);

    expect($serviceProvider)->not->toBeNull();
});

it('has correct package name', function () {
    expect(FilamentKnowledgeBaseServiceProvider::$name)->toBe('filament-knowledge-base');
});
