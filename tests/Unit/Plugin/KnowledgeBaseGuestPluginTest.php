<?php

use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBaseGuestPlugin;

it('can be instantiated via make', function () {
    $plugin = KnowledgeBaseGuestPlugin::make();

    expect($plugin)->toBeInstanceOf(KnowledgeBaseGuestPlugin::class);
});

it('has correct plugin id', function () {
    $plugin = KnowledgeBaseGuestPlugin::make();

    expect($plugin->getId())->toBe('filament-knowledge-base-guest');
});

it('can set navigation group', function () {
    $plugin = KnowledgeBaseGuestPlugin::make()->navigationGroup('Public KB');

    expect($plugin->getNavigationGroup())->toBe('Public KB');
});
