<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\ArticleResource\Pages;

use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\ArticleResource;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;
}
