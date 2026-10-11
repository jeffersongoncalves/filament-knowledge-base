<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\CategoryResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Pages\Concerns\ManagesCategoryTranslations;

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
