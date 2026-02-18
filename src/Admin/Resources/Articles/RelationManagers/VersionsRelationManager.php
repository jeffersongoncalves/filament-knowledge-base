<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\RelationManagers;

use Filament\Actions;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class VersionsRelationManager extends RelationManager
{
    protected static string $relationship = 'versions';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.versions.title');
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('version_number')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.versions.version_number'))
                    ->sortable(),
                TextColumn::make('title')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.versions.title_column'))
                    ->limit(50),
                TextColumn::make('change_notes')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.relation_managers.versions.change_notes'))
                    ->limit(80)
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('version_number', 'desc')
            ->recordActions([
                Actions\ViewAction::make()
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
