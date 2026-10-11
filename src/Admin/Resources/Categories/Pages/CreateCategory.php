<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\CategoryResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Pages\Concerns\ManagesCategoryTranslations;

class CreateCategory extends CreateRecord
{
    use ManagesCategoryTranslations;

    protected static string $resource = CategoryResource::class;
}
