<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CategoryResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CategoryResource\Pages\Concerns\ManagesCategoryTranslations;

class CreateCategory extends CreateRecord
{
    use ManagesCategoryTranslations;

    protected static string $resource = CategoryResource::class;
}
