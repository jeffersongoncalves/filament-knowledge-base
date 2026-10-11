<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Support;

use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;

/**
 * Badge colors and labels for article status/visibility.
 *
 * The core Article model casts `status` and `visibility` to enums, so Filament
 * passes enum instances as state. Plain strings are accepted too, so the badges
 * keep working with custom models that do not cast these attributes.
 */
class ArticleBadge
{
    public static function status(ArticleStatus|string|null $state): ?ArticleStatus
    {
        return $state instanceof ArticleStatus ? $state : ArticleStatus::tryFrom((string) $state);
    }

    public static function visibility(ArticleVisibility|string|null $state): ?ArticleVisibility
    {
        return $state instanceof ArticleVisibility ? $state : ArticleVisibility::tryFrom((string) $state);
    }

    public static function statusColor(ArticleStatus|string|null $state): string
    {
        return match (static::status($state)) {
            ArticleStatus::Published => 'success',
            ArticleStatus::Archived => 'danger',
            default => 'gray',
        };
    }

    public static function statusLabel(ArticleStatus|string|null $state): string
    {
        return static::status($state)?->label() ?? (string) ($state instanceof \BackedEnum ? $state->value : $state);
    }

    public static function visibilityColor(ArticleVisibility|string|null $state): string
    {
        return match (static::visibility($state)) {
            ArticleVisibility::Public => 'success',
            ArticleVisibility::Internal => 'warning',
            default => 'gray',
        };
    }

    public static function visibilityLabel(ArticleVisibility|string|null $state): string
    {
        return static::visibility($state)?->label() ?? (string) ($state instanceof \BackedEnum ? $state->value : $state);
    }
}
