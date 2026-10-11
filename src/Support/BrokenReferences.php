<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Support;

use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleContract;
use JeffersonGoncalves\KnowledgeBase\Support\ArticleAssets;

/**
 * The content that refers to a deleted or unknown asset, per language (see
 * design D6 and D10). Computed live from current content, so the warning
 * disappears by itself once the content is fixed.
 */
class BrokenReferences
{
    /**
     * @return array<string, list<string>>
     */
    public static function references(Model&ArticleContract $article): array
    {
        return app(ArticleAssets::class)->brokenReferences($article);
    }

    public static function has(?Model $article): bool
    {
        if (! $article instanceof ArticleContract) {
            return false;
        }

        return self::references($article) !== [];
    }

    /**
     * A sentence naming the affected languages and the missing assets.
     */
    public static function message(?Model $article): string
    {
        if (! $article instanceof ArticleContract) {
            return '';
        }

        $parts = [];

        foreach (self::references($article) as $locale => $assets) {
            $parts[] = strtoupper($locale).': '.implode(', ', $assets);
        }

        return __('filament-knowledge-base::knowledge-base.admin.assets.broken.message', [
            'details' => implode('; ', $parts),
        ]);
    }
}
