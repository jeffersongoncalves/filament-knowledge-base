<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\RelationManagers;

use Filament\Actions;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class FeedbackRelationManager extends RelationManager
{
    protected static string $relationship = 'feedback';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.feedback.title');
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_helpful')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.feedback.is_helpful'))
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedHandThumbUp)
                    ->falseIcon(Heroicon::OutlinedHandThumbDown)
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextColumn::make('comment')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.feedback.comment'))
                    ->limit(80)
                    ->toggleable(),
                TextColumn::make('ip_address')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.feedback.ip_address'))
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                TernaryFilter::make('is_helpful')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.feedback.is_helpful')),
            ])
            ->recordActions([
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
