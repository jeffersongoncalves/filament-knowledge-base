<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource;

class ViewArticle extends ViewRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
