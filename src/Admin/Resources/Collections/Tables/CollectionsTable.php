<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\Tables;

use Filament\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CollectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.collections.table.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.collections.table.slug'))
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('articles_count')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.collections.table.articles_count'))
                    ->counts('articles')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.collections.table.is_active'))
                    ->boolean()
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.collections.table.sort_order'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                TernaryFilter::make('is_active')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.collections.table.is_active')),
            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
