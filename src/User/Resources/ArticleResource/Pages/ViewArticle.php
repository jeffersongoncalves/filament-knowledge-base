<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\ArticleResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBaseUserPlugin;
use JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\ArticleResource;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleContract;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;

class ViewArticle extends ViewRecord
{
    protected static string $resource = ArticleResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        /** @var ArticleContract $article */
        $article = $this->getRecord();
        $article->incrementViewCount();
    }

    protected function getHeaderActions(): array
    {
        $actions = [];

        $hasFeedback = false;

        try {
            $hasFeedback = KnowledgeBaseUserPlugin::get()->hasFeedback();
        } catch (\Throwable) {
            $hasFeedback = config('filament-knowledge-base.features.feedback', true);
        }

        if ($hasFeedback) {
            $actions[] = Actions\Action::make('helpful')
                ->label(__('filament-knowledge-base::knowledge-base.user.articles.feedback.helpful'))
                ->icon('heroicon-o-hand-thumb-up')
                ->color('success')
                ->action(function () {
                    $this->submitFeedback(true);
                });

            $actions[] = Actions\Action::make('not_helpful')
                ->label(__('filament-knowledge-base::knowledge-base.user.articles.feedback.not_helpful'))
                ->icon('heroicon-o-hand-thumb-down')
                ->color('danger')
                ->action(function () {
                    $this->submitFeedback(false);
                });
        }

        return $actions;
    }

    protected function submitFeedback(bool $isHelpful): void
    {
        /** @var ArticleContract $article */
        $article = $this->getRecord();
        $user = auth()->user();

        app(KnowledgeBaseService::class)->addFeedback(
            article: $article,
            isHelpful: $isHelpful,
            user: $user,
            ipAddress: request()->ip(),
        );

        Notification::make()
            ->title(__('filament-knowledge-base::knowledge-base.user.articles.feedback.thanks'))
            ->success()
            ->send();
    }
}
