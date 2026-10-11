<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\Concerns;

use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\TranslatableArticleContract;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\TranslatableContract;
use JeffersonGoncalves\KnowledgeBase\Support\Locales;

/**
 * Reads and writes an article's per-language versions through the core's
 * translation rows when more than one language is configured.
 *
 * The form binds each language tab to `translations.<locale>.<field>` and the
 * page writes the rows here, after the article's own (shared) columns are
 * saved, so the core's mirror, slug and status rules do the enforcing (see
 * design D9). With a single configured language none of this runs and the
 * form stays bound to the article columns exactly as before (task 6.3).
 */
trait ManagesArticleTranslations
{
    /** @var array<string, array<string, mixed>>|null */
    protected ?array $submittedTranslations = null;

    protected bool $submittedFlagOtherLocalesOutdated = false;

    /**
     * The article row and its language versions are written in one save
     * (afterCreate/afterSave run inside Filament's transaction), so keep them
     * atomic whatever the panel's default.
     */
    public function hasDatabaseTransactions(): bool
    {
        return TranslationForm::isMultiLocale() || parent::hasDatabaseTransactions();
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (! TranslationForm::isMultiLocale()) {
            return $data;
        }

        $record = $this->getRecord();

        if (! $record instanceof TranslatableContract) {
            return $data;
        }

        $data['translations'] = TranslationForm::fill($record, TranslationForm::articleFields());
        $data['flag_other_locales_outdated'] = false;

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (! TranslationForm::isMultiLocale()) {
            return $data;
        }

        $this->captureSubmittedTranslations($data);

        return $this->withoutTranslationState($data);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (! TranslationForm::isMultiLocale()) {
            return $data;
        }

        $this->captureSubmittedTranslations($data);

        // The main row mirrors the authoritative version, which is always the
        // configured default language, so it has to carry that tab's content
        // on create.
        $source = Locales::default();

        foreach (TranslationForm::articleFields() as $field) {
            if (array_key_exists($field, $this->submittedTranslations[$source] ?? [])) {
                $data[$field] = $this->submittedTranslations[$source][$field];
            }
        }

        return $this->withoutTranslationState($data);
    }

    protected function afterCreate(): void
    {
        $this->persistArticleTranslations();
    }

    protected function afterSave(): void
    {
        $this->persistArticleTranslations();
    }

    protected function persistArticleTranslations(): void
    {
        if (! TranslationForm::isMultiLocale()) {
            return;
        }

        $article = $this->getRecord();

        if (! $article instanceof TranslatableArticleContract) {
            return;
        }

        $source = $article->authoritativeLocale();

        foreach (TranslationForm::locales() as $locale) {
            $values = $this->submittedTranslations[$locale] ?? [];

            if (TranslationForm::isEmpty($values, TranslationForm::articleFields())) {
                continue;
            }

            $payload = array_intersect_key($values, array_flip(TranslationForm::articleFields()));

            // The authoritative version's status follows the article (design
            // D2); only non-authoritative versions carry their own status, and
            // an unset one is left to the column default on insert.
            if ($locale !== $source && filled($values['status'] ?? null)) {
                $payload['status'] = $values['status'];
            }

            $translation = $article->translation($locale);

            if ($translation instanceof Model) {
                $translation->fill($payload);
                $translation->save();
            } else {
                $article->translations()->create([...$payload, 'locale' => $locale]);
            }
        }

        if ($this->submittedFlagOtherLocalesOutdated) {
            $article->flagOtherTranslationsOutdated();
        }
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function captureSubmittedTranslations(array $data): void
    {
        $translations = $data['translations'] ?? [];
        $this->submittedTranslations = is_array($translations) ? $translations : [];

        $this->submittedFlagOtherLocalesOutdated = (bool) ($data['flag_other_locales_outdated'] ?? false);
    }

    /**
     * Drop the translation-only form state before it reaches the article row.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function withoutTranslationState(array $data): array
    {
        unset($data['translations'], $data['flag_other_locales_outdated']);

        return $data;
    }
}
