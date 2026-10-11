<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CollectionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CollectionResource;

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
