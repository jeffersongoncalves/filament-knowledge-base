<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Support;

use Closure;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\TranslatableContract;
use JeffersonGoncalves\KnowledgeBase\Support\Locales;
use JeffersonGoncalves\KnowledgeBase\Support\SlugOwnership;

/**
 * Bridges Filament form state and the core's translation rows.
 *
 * When more than one language is configured, each language's fields are bound
 * to a nested `translations.<locale>.<field>` path and written to (or read
 * from) the core's translation rows by the page concerns. With a single
 * configured language nothing here is used: the forms stay bound to the
 * article/category columns exactly as before (see task 6.3).
 */
class TranslationForm
{
    /** @return list<string> */
    public static function locales(): array
    {
        return Locales::all();
    }

    public static function isMultiLocale(): bool
    {
        return count(static::locales()) > 1;
    }

    /** @return list<string> */
    public static function articleFields(): array
    {
        return ['title', 'slug', 'excerpt', 'content', 'seo_title', 'seo_description', 'seo_keywords'];
    }

    /** @return list<string> */
    public static function categoryFields(): array
    {
        return ['name', 'slug', 'description'];
    }

    /**
     * The nested form state for a record: one entry per configured language
     * with the fields to edit (and `status` for article versions).
     *
     * @param  list<string>  $fields
     * @return array<string, array<string, mixed>>
     */
    public static function fill(Model&TranslatableContract $record, array $fields): array
    {
        $translations = [];

        foreach (static::locales() as $locale) {
            $translation = $record->translation($locale);

            $translations[$locale] = $translation instanceof Model
                ? static::only($translation, array_merge($fields, ['status']))
                : [];
        }

        return $translations;
    }

    /**
     * The language state of a record's version (missing/draft/published/outdated).
     *
     * Uses the eager-loaded `translations` relation when present (the article
     * list loads it), so a list page does not query once per row and language.
     */
    public static function state(Model $record, string $locale): string
    {
        if (! $record instanceof TranslatableContract) {
            return LocalizationState::MISSING;
        }

        $translation = $record->relationLoaded('translations')
            ? $record->getRelation('translations')->firstWhere('locale', $locale)
            : $record->translation($locale);

        return LocalizationState::of($translation instanceof Model ? $translation : null);
    }

    /**
     * Validation for a language tab's slug: a slug belongs to one record, in
     * any language (core design D1a). Without it, a taken slug reaches the
     * core's save guard as an exception instead of a form error.
     *
     * Returned as a Filament rule closure, so the edited record is injected.
     *
     * @param  class-string<Model>  $translationClass
     */
    public static function uniqueSlugRule(string $translationClass, string $foreignKey): Closure
    {
        return fn (?Model $record): Closure => function (string $attribute, mixed $value, Closure $fail) use ($record, $translationClass, $foreignKey): void {
            if (! is_string($value) || $value === '') {
                return;
            }

            if (SlugOwnership::isTakenByAnother($translationClass, $foreignKey, $record?->getKey(), $value)) {
                $fail(__('validation.unique', ['attribute' => 'slug']));
            }
        };
    }

    /**
     * Whether a submitted language tab is empty and should not create a
     * translation row. A tab with only a status (e.g. a defaulted draft) is
     * still empty, and so is a rich-text field that only holds empty markup
     * (`<p></p>`), which Filament's editor submits for an untouched tab.
     *
     * @param  array<string, mixed>  $data
     * @param  list<string>  $fields
     */
    public static function isEmpty(array $data, array $fields): bool
    {
        foreach ($fields as $field) {
            $value = $data[$field] ?? null;

            if ($field === 'content' && static::isBlankHtml($value)) {
                continue;
            }

            if (filled($value)) {
                return false;
            }
        }

        return true;
    }

    protected static function isBlankHtml(mixed $value): bool
    {
        if (! is_string($value)) {
            return blank($value);
        }

        $text = html_entity_decode(strip_tags($value), ENT_QUOTES | ENT_HTML5);

        return trim($text, " \t\n\r\0\x0B\xC2\xA0") === '';
    }

    /**
     * Keep only the given attributes that are present on the model.
     *
     * @param  list<string>  $fields
     * @return array<string, mixed>
     */
    public static function only(Model $model, array $fields): array
    {
        $values = [];

        foreach ($fields as $field) {
            if ($model->hasAttribute($field) || array_key_exists($field, $model->getAttributes())) {
                $values[$field] = $model->getAttribute($field);
            }
        }

        return $values;
    }
}
