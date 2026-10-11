<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\Pages\Concerns\ManagesArticleTranslations;

class EditArticle extends EditRecord
{
    use ManagesArticleTranslations;

    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
