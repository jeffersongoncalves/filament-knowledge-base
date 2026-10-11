<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\ArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\Concerns\ManagesArticleTranslations;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;

class CreateArticle extends CreateRecord
{
    use ManagesArticleTranslations {
        mutateFormDataBeforeCreate as prepareTranslations;
    }

    protected static string $resource = ArticleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data = $this->prepareTranslations($data);

        $user = auth()->user();

        if ($user) {
            $data['author_type'] = get_class($user);
            $data['author_id'] = $user->getKey();
        }

        return $data;
    }

    /**
     * Create the article with the chosen authoritative language already set,
     * so the core's mirror writes the first version in that language rather
     * than the configured default.
     *
     * @param  array<string, mixed>  $data
     */
    protected function handleRecordCreation(array $data): Model
    {
        if (! TranslationForm::isMultiLocale() || $this->submittedSourceLocale === null) {
            return parent::handleRecordCreation($data);
        }

        $article = new (static::getModel())($data);
        $article->setAttribute('source_locale', $this->submittedSourceLocale);
        $article->save();

        return $article;
    }
}
