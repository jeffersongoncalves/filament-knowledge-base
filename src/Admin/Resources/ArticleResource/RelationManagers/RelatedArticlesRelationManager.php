<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ArticleBadge;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;

class RelatedArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'relatedArticles';

    public static function getTitle($ownerRecord, string $pageClass): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.related_articles.title');
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.status'))
                    ->badge()
                    ->color(fn (ArticleStatus|string|null $state): string => ArticleBadge::statusColor($state))
                    ->formatStateUsing(fn (ArticleStatus|string|null $state): string => ArticleBadge::statusLabel($state)),
                Tables\Columns\TextColumn::make('pivot.sort_order')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.sort_order'))
                    ->sortable(query: fn (Builder $query, string $direction): Builder => $query->orderBy($this->pivotSortColumn(), $direction)),
            ])
            // Sort on the qualified pivot column: 'pivot.sort_order' is not a real column.
            ->defaultSort(fn (Builder $query): Builder => $query->orderBy($this->pivotSortColumn()))
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\TextInput::make('sort_order')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.sort_order'))
                            ->numeric()
                            ->default(0),
                    ]),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }

    protected function pivotSortColumn(): string
    {
        $relationship = $this->getRelationship();

        return $relationship instanceof BelongsToMany
            ? $relationship->qualifyPivotColumn('sort_order')
            : 'sort_order';
    }
}
