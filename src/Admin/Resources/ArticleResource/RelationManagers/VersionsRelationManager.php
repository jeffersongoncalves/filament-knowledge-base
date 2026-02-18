<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VersionsRelationManager extends RelationManager
{
    protected static string $relationship = 'versions';

    public static function getTitle($ownerRecord, string $pageClass): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.versions.title');
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('version_number')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.versions.version_number'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.versions.title_column'))
                    ->limit(50),
                Tables\Columns\TextColumn::make('change_notes')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.versions.change_notes'))
                    ->limit(80)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('version_number', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->form([
                        Forms\Components\TextInput::make('version_number')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.versions.version_number'))
                            ->disabled(),
                        Forms\Components\TextInput::make('title')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.versions.title_column'))
                            ->disabled(),
                        Forms\Components\RichEditor::make('content')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.content'))
                            ->disabled()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('change_notes')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.versions.change_notes'))
                            ->disabled()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
