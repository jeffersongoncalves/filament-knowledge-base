<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
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
                    ->color(fn (string $state): string => match ($state) {
                        ArticleStatus::Draft->value => 'gray',
                        ArticleStatus::Published->value => 'success',
                        ArticleStatus::Archived->value => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ArticleStatus::from($state)->label()),
                Tables\Columns\TextColumn::make('pivot.sort_order')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.sort_order'))
                    ->sortable(),
            ])
            ->defaultSort('pivot.sort_order')
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
}
