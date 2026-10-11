<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\Pages;

use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\CollectionResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\Pages\Concerns\ManagesCollectionTranslations;

class EditCollection extends EditRecord
{
    use ManagesCollectionTranslations;

    protected static string $resource = CollectionResource::class;
}
