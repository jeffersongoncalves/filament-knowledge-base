<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CollectionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CollectionResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CollectionResource\Pages\Concerns\ManagesCollectionTranslations;

class EditCollection extends EditRecord
{
    use ManagesCollectionTranslations;

    protected static string $resource = CollectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
