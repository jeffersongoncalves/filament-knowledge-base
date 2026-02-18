<?php

it('loads filament-knowledge-base config file', function () {
    expect(config('filament-knowledge-base'))->toBeArray();
});

it('has default navigation config for admin', function () {
    $config = config('filament-knowledge-base.navigation.admin');

    expect($config)->toBeArray()
        ->toHaveKeys(['group', 'sort', 'icon']);

    expect($config['group'])->toBe('Knowledge Base');
    expect($config['sort'])->toBeNull();
    expect($config['icon'])->toBe('heroicon-o-book-open');
});

it('has default navigation config for user', function () {
    $config = config('filament-knowledge-base.navigation.user');

    expect($config)->toBeArray()
        ->toHaveKeys(['group', 'sort', 'icon']);

    expect($config['group'])->toBe('Knowledge Base');
});

it('has default navigation config for guest', function () {
    $config = config('filament-knowledge-base.navigation.guest');

    expect($config)->toBeArray()
        ->toHaveKeys(['group', 'sort', 'icon']);

    expect($config['group'])->toBe('Knowledge Base');
});

it('has feature toggles config', function () {
    $features = config('filament-knowledge-base.features');

    expect($features)->toBeArray()
        ->toHaveKeys(['versioning', 'feedback', 'related_articles', 'seo']);

    expect($features['versioning'])->toBeTrue();
    expect($features['feedback'])->toBeTrue();
    expect($features['related_articles'])->toBeTrue();
    expect($features['seo'])->toBeTrue();
});
