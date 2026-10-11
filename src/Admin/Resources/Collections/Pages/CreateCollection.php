<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\CollectionResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\Pages\Concerns\ManagesCollectionTranslations;

class CreateCollection extends CreateRecord
{
    use ManagesCollectionTranslations;

    protected static string $resource = CollectionResource::class;

    // Save and Cancel stay in view while editing a long form.
    public static bool $formActionsAreSticky = true;
}
