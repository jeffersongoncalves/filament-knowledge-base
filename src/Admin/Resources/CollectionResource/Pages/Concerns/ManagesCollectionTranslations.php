<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CollectionResource\Pages\Concerns;

use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\CollectionContract;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\TranslatableContract;
use JeffersonGoncalves\KnowledgeBase\Support\Locales;

/**
 * Persists a collection: its per-language name/slug/description through the
 * core's translation rows, and its ordered articles on the pivot.
 *
 * With a single configured language the form stays bound to the collection
 * columns, exactly like the single-language admin (task 4.1). The core's mirror,
 * slug and ordering rules do the enforcing.
 */
trait ManagesCollectionTranslations
{
    /** @var array<string, array<string, mixed>>|null */
    protected ?array $submittedTranslations = null;

    /** @var array<int|string, mixed> */
    protected array $submittedArticles = [];

    /**
     * The collection row, its language versions and its article pivot are
     * written in one save (afterCreate/afterSave run inside Filament's
     * transaction), so keep them atomic whatever the panel's default.
     */
    public function hasDatabaseTransactions(): bool
    {
        return true;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $record = $this->getRecord();

        if (TranslationForm::isMultiLocale() && $record instanceof TranslatableContract) {
            $data['translations'] = TranslationForm::fill($record, TranslationForm::collectionFields());
        }

        if ($record instanceof CollectionContract) {
            $data['articles'] = array_map(
                fn (int $id): array => ['id' => $id],
                $record->articleIds(),
            );
        }

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->captureArticles($data);

        unset($data['articles']);

        if (TranslationForm::isMultiLocale()) {
            $this->captureSubmittedTranslations($data);

            unset($data['translations']);
        }

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->captureArticles($data);

        unset($data['articles']);

        if (TranslationForm::isMultiLocale()) {
            $this->captureSubmittedTranslations($data);

            // The main row mirrors the default-language version.
            $default = Locales::default();

            foreach (TranslationForm::collectionFields() as $field) {
                if (array_key_exists($field, $this->submittedTranslations[$default] ?? [])) {
                    $data[$field] = $this->submittedTranslations[$default][$field];
                }
            }

            unset($data['translations']);
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $this->persistCollectionTranslations();
        $this->persistArticles();
    }

    protected function afterSave(): void
    {
        $this->persistCollectionTranslations();
        $this->persistArticles();
    }

    protected function persistCollectionTranslations(): void
    {
        if (! TranslationForm::isMultiLocale()) {
            return;
        }

        $collection = $this->getRecord();

        if (! $collection instanceof TranslatableContract) {
            return;
        }

        foreach (TranslationForm::locales() as $locale) {
            $values = $this->submittedTranslations[$locale] ?? [];

            if (TranslationForm::isEmpty($values, TranslationForm::collectionFields())) {
                continue;
            }

            $payload = array_intersect_key($values, array_flip(TranslationForm::collectionFields()));

            $translation = $collection->translation($locale);

            if ($translation instanceof Model) {
                $translation->fill($payload);
                $translation->save();
            } else {
                $collection->translations()->create([...$payload, 'locale' => $locale]);
            }
        }
    }

    /**
     * Write the chosen articles and their order to the pivot, in the order the
     * editor left them.
     */
    protected function persistArticles(): void
    {
        $collection = $this->getRecord();

        if (! $collection instanceof CollectionContract) {
            return;
        }

        $sync = [];
        $position = 0;

        foreach ($this->submittedArticles as $item) {
            $id = is_array($item) ? ($item['id'] ?? null) : null;

            if ($id === null || $id === '') {
                continue;
            }

            $sync[(int) $id] = ['sort_order' => $position++];
        }

        $collection->articles()->sync($sync);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function captureArticles(array $data): void
    {
        $articles = $data['articles'] ?? [];

        $this->submittedArticles = is_array($articles) ? array_values($articles) : [];
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
