<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Concerns;

use Filament\Panel;

/**
 * Prepends `filament-knowledge-base.slug_prefix` to a resource's slug, so its
 * URLs and route names do not clash with another plugin's resource of the
 * same name (e.g. `categories` from filament-help-desk) in the same panel.
 */
trait HasSlugPrefix
{
    public static function getSlug(?Panel $panel = null): string
    {
        $slug = parent::getSlug($panel);
        $prefix = trim((string) config('filament-knowledge-base.slug_prefix'), '/');

        return $prefix === '' ? $slug : "{$prefix}/{$slug}";
    }
}
