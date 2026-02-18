<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;

class KnowledgeBaseOverviewWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $articleModel = ModelResolver::article();
        $categoryModel = ModelResolver::category();

        $totalArticles = $articleModel::count();
        $publishedArticles = $articleModel::where('status', ArticleStatus::Published->value)->count();
        $draftArticles = $articleModel::where('status', ArticleStatus::Draft->value)->count();
        $totalCategories = $categoryModel::count();
        $totalViews = $articleModel::sum('view_count');

        $helpfulCount = $articleModel::sum('helpful_count');
        $notHelpfulCount = $articleModel::sum('not_helpful_count');
        $totalFeedback = $helpfulCount + $notHelpfulCount;
        $helpfulPercentage = $totalFeedback > 0
            ? round(($helpfulCount / $totalFeedback) * 100, 1)
            : 0;

        return [
            Stat::make(
                __('filament-knowledge-base::knowledge-base.admin.widgets.overview.total_articles'),
                $totalArticles
            ),
            Stat::make(
                __('filament-knowledge-base::knowledge-base.admin.widgets.overview.published'),
                $publishedArticles
            )
                ->color('success'),
            Stat::make(
                __('filament-knowledge-base::knowledge-base.admin.widgets.overview.drafts'),
                $draftArticles
            )
                ->color('warning'),
            Stat::make(
                __('filament-knowledge-base::knowledge-base.admin.widgets.overview.categories'),
                $totalCategories
            ),
            Stat::make(
                __('filament-knowledge-base::knowledge-base.admin.widgets.overview.total_views'),
                number_format($totalViews)
            ),
            Stat::make(
                __('filament-knowledge-base::knowledge-base.admin.widgets.overview.helpful_rate'),
                $helpfulPercentage . '%'
            )
                ->color($helpfulPercentage >= 70 ? 'success' : ($helpfulPercentage >= 40 ? 'warning' : 'danger')),
        ];
    }
}
