<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\CategoryResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Pages\Concerns\ManagesCategoryTranslations;

class CreateCategory extends CreateRecord
{
    use ManagesCategoryTranslations;

    protected static string $resource = CategoryResource::class;

    // Save and Cancel stay in view while editing a long form.
    public static bool $formActionsAreSticky = true;
}
