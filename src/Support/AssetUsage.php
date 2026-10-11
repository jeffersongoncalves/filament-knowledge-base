<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Support;

use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleAssetContract;
use JeffersonGoncalves\KnowledgeBase\Support\ArticleAssets;
use JeffersonGoncalves\KnowledgeBase\Support\Locales;

/**
 * Turns an asset's scope and usage into the labels the asset manager shows
 * (see design D10). The usage is always computed from current content by the
 * core, so it can never drift from the article.
 */
class AssetUsage
{
    /**
     * @return list<string>
     */
    public static function locales(Model&ArticleAssetContract $asset): array
    {
        return app(ArticleAssets::class)->usage($asset);
    }

    /**
     * "Shared" or the language code, for the scope column.
     */
    public static function scopeLabel(Model&ArticleAssetContract $asset): string
    {
        if ($asset->isShared()) {
            return __('filament-knowledge-base::knowledge-base.admin.assets.scope.shared');
        }

        return strtoupper((string) $asset->getAttribute('locale'));
    }

    /**
     * "Used in EN, DE", or "Unused".
     */
    public static function usageLabel(Model&ArticleAssetContract $asset): string
    {
        $locales = array_map(
            fn (string $locale): string => strtoupper($locale),
            self::locales($asset),
        );

        if ($locales === []) {
            return __('filament-knowledge-base::knowledge-base.admin.assets.usage.unused');
        }

        return __('filament-knowledge-base::knowledge-base.admin.assets.usage.used_in', [
            'languages' => implode(', ', $locales),
        ]);
    }

    /**
     * The delete confirmation: names the languages that still use the asset, or
     * says it is unused. Deleting is allowed either way (design D7).
     */
    public static function deleteWarning(Model&ArticleAssetContract $asset): string
    {
        $locales = array_map(
            fn (string $locale): string => strtoupper($locale),
            self::locales($asset),
        );

        if ($locales === []) {
            return __('filament-knowledge-base::knowledge-base.admin.assets.delete.unused');
        }

        return __('filament-knowledge-base::knowledge-base.admin.assets.delete.used', [
            'languages' => implode(', ', $locales),
        ]);
    }

    /**
     * The scope options for the manager's filter and upload form: shared plus
     * every configured language except the default (the default's assets are
     * shared).
     *
     * @return array<string, string>
     */
    public static function scopeOptions(): array
    {
        $options = ['shared' => __('filament-knowledge-base::knowledge-base.admin.assets.scope.shared')];

        foreach (Locales::all() as $locale) {
            if ($locale === Locales::default()) {
                continue;
            }

            $options[$locale] = strtoupper($locale);
        }

        return $options;
    }
}
