<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Guest\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\PublicVisibility;

class PopularArticlesWidget extends BaseWidget
{
    protected static ?string $heading = null;

    protected int|string|array $columnSpan = 'full';

    public function getHeading(): ?string
    {
        return __('filament-knowledge-base::knowledge-base.guest.widgets.popular_articles.heading');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(PublicVisibility::popularArticlesQuery())
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.category')),
                Tables\Columns\TextColumn::make('view_count')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.view_count'))
                    ->numeric()
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
