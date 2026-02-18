<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\ArticleResource;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();

        if ($user) {
            $data['author_type'] = get_class($user);
            $data['author_id'] = $user->getKey();
        }

        if (empty($data['uuid'])) {
            $data['uuid'] = (string) Str::uuid();
        }

        return $data;
    }
}
