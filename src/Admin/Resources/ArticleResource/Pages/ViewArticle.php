<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\Actions\ViewOnSiteAction;

class ViewArticle extends ViewRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewOnSiteAction::make(),
            Actions\EditAction::make(),
        ];
    }
}
