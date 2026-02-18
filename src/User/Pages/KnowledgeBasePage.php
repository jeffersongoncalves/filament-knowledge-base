<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\User\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBaseUserPlugin;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;
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
        $categoryModel = ModelResolver::category();

        return $categoryModel::query()
            ->where('is_active', true)
            ->where('visibility', 'public')
            ->whereNull('parent_id')
            ->withCount(['articles' => function ($query) {
                $query->where('status', ArticleStatus::Published->value)
                    ->where('visibility', ArticleVisibility::Public->value);
            }])
            ->orderBy('sort_order')
            ->get();
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
