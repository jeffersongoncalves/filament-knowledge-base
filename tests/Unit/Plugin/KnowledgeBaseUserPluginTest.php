<?php

use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBaseUserPlugin;

it('can be instantiated via make', function () {
    $plugin = KnowledgeBaseUserPlugin::make();

    expect($plugin)->toBeInstanceOf(KnowledgeBaseUserPlugin::class);
});

it('has correct plugin id', function () {
    $plugin = KnowledgeBaseUserPlugin::make();

    expect($plugin->getId())->toBe('filament-knowledge-base-user');
});

it('has feedback enabled by default', function () {
    $plugin = KnowledgeBaseUserPlugin::make();

    expect($plugin->hasFeedback())->toBeTrue();
});

it('can disable feedback', function () {
    $plugin = KnowledgeBaseUserPlugin::make()->feedback(false);

    expect($plugin->hasFeedback())->toBeFalse();
});

it('can set navigation group', function () {
    $plugin = KnowledgeBaseUserPlugin::make()->navigationGroup('Support');

    expect($plugin->getNavigationGroup())->toBe('Support');
});
