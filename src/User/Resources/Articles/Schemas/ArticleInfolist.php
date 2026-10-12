<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\Articles\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ContentAttachments;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make()
                ->schema([
                    TextEntry::make('title')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.title'))
                        ->columnSpanFull(),
                    TextEntry::make('category.name')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.category'))
                        ->badge(),
                    TextEntry::make('published_at')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.published_at'))
                        ->dateTime(),
                    TextEntry::make('view_count')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.view_count')),
                ])->columns(3),
            Section::make()
                ->schema([
                    TextEntry::make('excerpt')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.excerpt'))
                        ->columnSpanFull()
                        ->visible(fn ($record) => filled($record->excerpt)),
                    // Customers see only working asset references, at their current URLs.
                    TextEntry::make('content')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.content'))
                        ->formatStateUsing(fn (mixed $state, mixed $record): string => ContentAttachments::displayContent($state, $record, forPublic: true))
                        ->html()
                        ->columnSpanFull(),
                ]),
        ]);
    }
}
