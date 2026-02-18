<?php

use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBasePlugin;

it('can be instantiated via make', function () {
    $plugin = KnowledgeBasePlugin::make();

    expect($plugin)->toBeInstanceOf(KnowledgeBasePlugin::class);
});

it('has correct plugin id', function () {
    $plugin = KnowledgeBasePlugin::make();

    expect($plugin->getId())->toBe('filament-knowledge-base');
});

it('has versioning enabled by default', function () {
    $plugin = KnowledgeBasePlugin::make();

    expect($plugin->hasVersioning())->toBeTrue();
});

it('can disable versioning', function () {
    $plugin = KnowledgeBasePlugin::make()->versioning(false);

    expect($plugin->hasVersioning())->toBeFalse();
});

it('has feedback enabled by default', function () {
    $plugin = KnowledgeBasePlugin::make();

    expect($plugin->hasFeedback())->toBeTrue();
});

it('can disable feedback', function () {
    $plugin = KnowledgeBasePlugin::make()->feedback(false);

    expect($plugin->hasFeedback())->toBeFalse();
});

it('has related articles enabled by default', function () {
    $plugin = KnowledgeBasePlugin::make();

    expect($plugin->hasRelatedArticles())->toBeTrue();
});

it('can disable related articles', function () {
    $plugin = KnowledgeBasePlugin::make()->relatedArticles(false);

    expect($plugin->hasRelatedArticles())->toBeFalse();
});

it('has seo enabled by default', function () {
    $plugin = KnowledgeBasePlugin::make();

    expect($plugin->hasSeo())->toBeTrue();
});

it('can disable seo', function () {
    $plugin = KnowledgeBasePlugin::make()->seo(false);

    expect($plugin->hasSeo())->toBeFalse();
});

it('can set navigation group', function () {
    $plugin = KnowledgeBasePlugin::make()->navigationGroup('Custom Group');

    expect($plugin->getNavigationGroup())->toBe('Custom Group');
});

it('has null navigation group by default', function () {
    $plugin = KnowledgeBasePlugin::make();

    expect($plugin->getNavigationGroup())->toBeNull();
});

it('can set navigation sort', function () {
    $plugin = KnowledgeBasePlugin::make()->navigationSort(5);

    expect($plugin->getNavigationSort())->toBe(5);
});

it('can set navigation icon', function () {
    $plugin = KnowledgeBasePlugin::make()->navigationIcon('heroicon-o-book-open');

    expect($plugin->getNavigationIcon())->toBe('heroicon-o-book-open');
});

it('respects config-level feature toggle for versioning', function () {
    config(['filament-knowledge-base.features.versioning' => false]);

    $plugin = KnowledgeBasePlugin::make()->versioning(true);

    expect($plugin->hasVersioning())->toBeFalse();
});

it('respects config-level feature toggle for feedback', function () {
    config(['filament-knowledge-base.features.feedback' => false]);

    $plugin = KnowledgeBasePlugin::make()->feedback(true);

    expect($plugin->hasFeedback())->toBeFalse();
});
