<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\User\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\PublicVisibility;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;

class PopularArticlesWidget extends BaseWidget
{
    protected static ?string $heading = null;

    protected int|string|array $columnSpan = 'full';

    public function getHeading(): ?string
    {
        return __('filament-knowledge-base::knowledge-base.user.widgets.popular_articles.heading');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(PublicVisibility::popularArticlesQuery(audience: ArticleVisibility::Customers))
            ->columns([
                TextColumn::make('title')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.title'))
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.category')),
                TextColumn::make('view_count')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.view_count'))
                    ->numeric()
                    ->sortable(),
            ])
            ->paginated(false);
    }
}
