<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\ArticleResource\Pages;

use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\ArticleResource;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;
}
