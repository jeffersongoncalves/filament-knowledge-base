<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBaseGuestPlugin;

/**
 * The customer-facing guest panel, so its pages can be rendered in tests.
 */
class GuestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('guest')
            ->path('guest')
            ->plugins([
                KnowledgeBaseGuestPlugin::make(),
            ]);
    }
}
