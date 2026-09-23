<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\Articles\Pages;

use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\Articles\ArticleResource;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleContract;

class ViewArticle extends ViewRecord
{
    protected static string $resource = ArticleResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        /** @var Model&ArticleContract $article */
        $article = $this->getRecord();
        $article->incrementViewCount();
    }
}
