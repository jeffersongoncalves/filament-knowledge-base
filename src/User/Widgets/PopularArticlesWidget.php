<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\User\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;

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
        $articleModel = ModelResolver::article();

        return $table
            ->query(
                $articleModel::query()
                    ->where('status', ArticleStatus::Published->value)
                    ->where('visibility', ArticleVisibility::Public->value)
                    ->orderByDesc('view_count')
                    ->limit(5)
            )
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
