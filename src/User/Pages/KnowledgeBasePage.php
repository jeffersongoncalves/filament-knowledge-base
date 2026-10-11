<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\User\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBaseUserPlugin;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\PublicVisibility;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use Livewire\Attributes\Url;

class KnowledgeBasePage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMagnifyingGlass;

    protected string $view = 'filament-knowledge-base::pages.knowledge-base';

    protected static ?int $navigationSort = 1;

    #[Url]
    public string $search = '';

    public static function getNavigationGroup(): ?string
    {
        try {
            return KnowledgeBaseUserPlugin::get()->getNavigationGroup()
                ?? config('filament-knowledge-base.navigation.user.group', 'Knowledge Base');
        } catch (\Throwable) {
            return config('filament-knowledge-base.navigation.user.group', 'Knowledge Base');
        }
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.user.pages.knowledge_base.navigation_label');
    }

    public function getTitle(): string
    {
        return __('filament-knowledge-base::knowledge-base.user.pages.knowledge_base.title');
    }

    public function getCategories(): Collection
    {
        return PublicVisibility::rootCategories();
    }

    public function getSearchResults(): Collection
    {
        if (strlen($this->search) < 2) {
            return collect();
        }

        return app(KnowledgeBaseService::class)->search($this->search, [
            'visibility' => ArticleVisibility::Public->value,
        ]);
    }
}
