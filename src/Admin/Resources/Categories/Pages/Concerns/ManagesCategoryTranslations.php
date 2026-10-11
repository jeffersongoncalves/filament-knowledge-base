<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Pages\Concerns;

use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\TranslatableContract;
use JeffersonGoncalves\KnowledgeBase\Support\Locales;

/**
 * Reads and writes a category's per-language versions through the core's
 * translation rows when more than one language is configured.
 *
 * Categories always have a version in the configured default language (the
 * main row mirrors it), so only the other languages are true translations;
 * the core's slug and mirror rules still do the enforcing. With a single
 * configured language the form stays bound to the category columns exactly as
 * before (task 6.3).
 */
trait ManagesCategoryTranslations
{
    /** @var array<string, array<string, mixed>>|null */
    protected ?array $submittedTranslations = null;

    /**
     * The category row and its language versions are written in one save
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

        $data['translations'] = TranslationForm::fill($record, TranslationForm::categoryFields());

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

        unset($data['translations']);

        return $data;
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

        // The main row mirrors the default-language version.
        $default = Locales::default();

        foreach (TranslationForm::categoryFields() as $field) {
            if (array_key_exists($field, $this->submittedTranslations[$default] ?? [])) {
                $data[$field] = $this->submittedTranslations[$default][$field];
            }
        }

        unset($data['translations']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $this->persistCategoryTranslations();
    }

    protected function afterSave(): void
    {
        $this->persistCategoryTranslations();
    }

    protected function persistCategoryTranslations(): void
    {
        if (! TranslationForm::isMultiLocale()) {
            return;
        }

        $category = $this->getRecord();

        if (! $category instanceof TranslatableContract) {
            return;
        }

        foreach (TranslationForm::locales() as $locale) {
            $values = $this->submittedTranslations[$locale] ?? [];

            if (TranslationForm::isEmpty($values, TranslationForm::categoryFields())) {
                continue;
            }

            $payload = array_intersect_key($values, array_flip(TranslationForm::categoryFields()));

            $translation = $category->translation($locale);

            if ($translation instanceof Model) {
                $translation->fill($payload);
                $translation->save();
            } else {
                $category->translations()->create([...$payload, 'locale' => $locale]);
            }
        }
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function captureSubmittedTranslations(array $data): void
    {
        $translations = $data['translations'] ?? [];
        $this->submittedTranslations = is_array($translations) ? $translations : [];
    }
}
