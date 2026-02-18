<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\ArticleResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\ArticleResource;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleContract;

class ViewArticle extends ViewRecord
{
    protected static string $resource = ArticleResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        /** @var ArticleContract $article */
        $article = $this->getRecord();
        $article->incrementViewCount();
    }
}
