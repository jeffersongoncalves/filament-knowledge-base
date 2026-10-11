<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Support;

use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\KnowledgeBase\Enums\TranslationStatus;

/**
 * The per-language state of an article version as shown in the admin, one of
 * missing, draft, published or outdated (see the localization-admin spec).
 *
 * The state is derived from the core's translation row; the plugin does not
 * keep any state of its own.
 */
class LocalizationState
{
    public const MISSING = 'missing';

    public const DRAFT = 'draft';

    public const PUBLISHED = 'published';

    public const OUTDATED = 'outdated';

    /**
     * The state of a translation row, or MISSING when there is none.
     */
    public static function of(?Model $translation): string
    {
        if (! $translation instanceof Model) {
            return self::MISSING;
        }

        if ((bool) $translation->getAttribute('is_outdated')) {
            return self::OUTDATED;
        }

        $status = $translation->getAttribute('status');

        $published = $status instanceof TranslationStatus
            ? $status === TranslationStatus::Published
            : $status === TranslationStatus::Published->value;

        return $published ? self::PUBLISHED : self::DRAFT;
    }

    public static function label(string $state): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.localization.state.'.$state);
    }

    public static function color(string $state): string
    {
        return match ($state) {
            self::PUBLISHED => 'success',
            self::OUTDATED => 'warning',
            self::DRAFT => 'gray',
            default => 'danger',
        };
    }
}
