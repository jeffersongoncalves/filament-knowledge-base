<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\Articles\Tables;

use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.title'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.category'))
                    ->sortable(),
                TextColumn::make('published_at')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.published_at'))
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('view_count')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.view_count'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->recordActions([
                Actions\ViewAction::make(),
            ]);
    }
}
