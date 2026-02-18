<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class FeedbackRelationManager extends RelationManager
{
    protected static string $relationship = 'feedback';

    public static function getTitle($ownerRecord, string $pageClass): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.feedback.title');
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_helpful')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.feedback.is_helpful'))
                    ->boolean()
                    ->trueIcon('heroicon-o-hand-thumb-up')
                    ->falseIcon('heroicon-o-hand-thumb-down')
                    ->trueColor('success')
                    ->falseColor('danger'),
                Tables\Columns\TextColumn::make('comment')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.feedback.comment'))
                    ->limit(80)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('ip_address')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.feedback.ip_address'))
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_helpful')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.feedback.is_helpful')),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
