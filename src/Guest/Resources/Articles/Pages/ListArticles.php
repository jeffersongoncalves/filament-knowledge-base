<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\Articles\Pages;

use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\Articles\ArticleResource;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;
}
