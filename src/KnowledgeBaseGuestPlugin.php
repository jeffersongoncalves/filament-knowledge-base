<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase;

use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\FilamentKnowledgeBase\Concerns\HasKnowledgeBasePluginConfig;
use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Pages\KnowledgeBasePage;
use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\ArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Widgets\PopularArticlesWidget;

class KnowledgeBaseGuestPlugin implements Plugin
{
    use HasKnowledgeBasePluginConfig;

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function getId(): string
    {
        return 'filament-knowledge-base-guest';
    }

    public function register(Panel $panel): void
    {
        $resources = [
            ArticleResource::class,
        ];

        $pages = [
            KnowledgeBasePage::class,
        ];

        $widgets = [
            PopularArticlesWidget::class,
        ];

        $panel
            ->resources($resources)
            ->pages($pages)
            ->widgets($widgets);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
