<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBasePlugin;

class TestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->plugins([
                KnowledgeBasePlugin::make(),
            ]);
    }
}
