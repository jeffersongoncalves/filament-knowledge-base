<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Tables;

use Filament\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('parent.name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.parent'))
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('articles_count')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.articles_count'))
                    ->counts('articles')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.is_active'))
                    ->boolean()
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.sort_order'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.visibility'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'public' => 'success',
                        'internal' => 'warning',
                        default => 'gray',
                    })
                    ->toggleable(),
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
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.is_active')),
                SelectFilter::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.visibility'))
                    ->options([
                        'public' => __('filament-knowledge-base::knowledge-base.common.visibility.public'),
                        'internal' => __('filament-knowledge-base::knowledge-base.common.visibility.internal'),
                    ]),
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
