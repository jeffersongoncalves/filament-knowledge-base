<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase;

use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CategoryResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Widgets\KnowledgeBaseOverviewWidget;
use JeffersonGoncalves\FilamentKnowledgeBase\Concerns\HasKnowledgeBasePluginConfig;

class KnowledgeBasePlugin implements Plugin
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
        return 'filament-knowledge-base';
    }

    public function register(Panel $panel): void
    {
        $resources = [
            ArticleResource::class,
            CategoryResource::class,
        ];

        $widgets = [
            KnowledgeBaseOverviewWidget::class,
        ];

        $panel
            ->resources($resources)
            ->widgets($widgets);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
