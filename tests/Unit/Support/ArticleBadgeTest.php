<?php

use JeffersonGoncalves\FilamentKnowledgeBase\Support\ArticleBadge;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;

it('accepts the status enum the core model casts to', function () {
    expect(ArticleBadge::statusColor(ArticleStatus::Published))->toBe('success')
        ->and(ArticleBadge::statusColor(ArticleStatus::Archived))->toBe('danger')
        ->and(ArticleBadge::statusColor(ArticleStatus::Draft))->toBe('gray')
        ->and(ArticleBadge::statusLabel(ArticleStatus::Published))->toBe(ArticleStatus::Published->label());
});

it('still accepts plain status strings', function () {
    expect(ArticleBadge::statusColor('published'))->toBe('success')
        ->and(ArticleBadge::statusLabel('draft'))->toBe(ArticleStatus::Draft->label());
});

it('accepts the visibility enum the core model casts to', function () {
    expect(ArticleBadge::visibilityColor(ArticleVisibility::Public))->toBe('success')
        ->and(ArticleBadge::visibilityColor(ArticleVisibility::Internal))->toBe('warning')
        ->and(ArticleBadge::visibilityLabel(ArticleVisibility::Internal))->toBe(ArticleVisibility::Internal->label());
});

it('still accepts plain visibility strings', function () {
    expect(ArticleBadge::visibilityColor('internal'))->toBe('warning')
        ->and(ArticleBadge::visibilityLabel('public'))->toBe(ArticleVisibility::Public->label());
});

it('falls back gracefully on unknown or empty values', function () {
    expect(ArticleBadge::statusColor('unknown'))->toBe('gray')
        ->and(ArticleBadge::statusLabel('unknown'))->toBe('unknown')
        ->and(ArticleBadge::visibilityColor(null))->toBe('gray')
        ->and(ArticleBadge::visibilityLabel(null))->toBe('');
});
