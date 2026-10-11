<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CategoryResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CategoryResource\Pages\Concerns\ManagesCategoryTranslations;

class EditCategory extends EditRecord
{
    use ManagesCategoryTranslations;

    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
