<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CollectionResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CollectionResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CollectionResource\Pages\Concerns\ManagesCollectionTranslations;

class CreateCollection extends CreateRecord
{
    use ManagesCollectionTranslations;

    protected static string $resource = CollectionResource::class;
}
