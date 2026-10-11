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

    // Save and Cancel stay in view while editing a long form.
    public static bool $formActionsAreSticky = true;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
