<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\RelationManagers;

use Filament\Actions;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;

class RelatedArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'relatedArticles';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.related_articles.title');
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.title'))
                    ->searchable()
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
                TextColumn::make('pivot.sort_order')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.sort_order'))
                    ->sortable(),
            ])
            ->defaultSort('pivot.sort_order')
            ->headerActions([
                Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                        Forms\Components\TextInput::make('sort_order')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.sort_order'))
                            ->numeric()
                            ->default(0),
                    ]),
            ])
            ->recordActions([
                Actions\DetachAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
