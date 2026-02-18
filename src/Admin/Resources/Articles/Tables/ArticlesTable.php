<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Tables;

use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.title'))
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                TextColumn::make('category.name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.category'))
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        ArticleStatus::Draft->value => 'gray',
                        ArticleStatus::Published->value => 'success',
                        ArticleStatus::Archived->value => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ArticleStatus::from($state)->label()),
                TextColumn::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.visibility'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        ArticleVisibility::Public->value => 'success',
                        ArticleVisibility::Internal->value => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ArticleVisibility::from($state)->label())
                    ->toggleable(),
                TextColumn::make('view_count')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.view_count'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('published_at')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.published_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.status'))
                    ->options(collect(ArticleStatus::cases())->mapWithKeys(fn (ArticleStatus $status) => [
                        $status->value => $status->label(),
                    ])),
                SelectFilter::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.visibility'))
                    ->options(collect(ArticleVisibility::cases())->mapWithKeys(fn (ArticleVisibility $visibility) => [
                        $visibility->value => $visibility->label(),
                    ])),
                SelectFilter::make('category_id')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.category'))
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                TrashedFilter::make(),
            ])
            ->recordActions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                    Actions\ForceDeleteBulkAction::make(),
                    Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }
}
