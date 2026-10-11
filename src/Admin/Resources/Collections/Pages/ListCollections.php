<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\CollectionResource;

class ListCollections extends ListRecords
{
    protected static string $resource = CollectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
