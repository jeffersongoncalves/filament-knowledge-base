<?php

it('registers the filament-knowledge-base config', function () {
    expect(config('filament-knowledge-base'))->toBeArray();
});

it('publishes config with correct tag', function () {
    $serviceProvider = app()->getProvider(\JeffersonGoncalves\FilamentKnowledgeBase\FilamentKnowledgeBaseServiceProvider::class);

    expect($serviceProvider)->not->toBeNull();
});

it('has correct package name', function () {
    expect(\JeffersonGoncalves\FilamentKnowledgeBase\FilamentKnowledgeBaseServiceProvider::$name)->toBe('filament-knowledge-base');
});
