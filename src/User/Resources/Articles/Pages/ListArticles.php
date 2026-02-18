<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\Articles\Pages;

use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\Articles\ArticleResource;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;
}
