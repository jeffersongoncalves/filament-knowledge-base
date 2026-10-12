<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures;

use Filament\Panel;
use Filament\PanelProvider;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBaseUserPlugin;

/**
 * The customer-facing user panel, so its pages can be rendered in tests.
 */
class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('user')
            ->path('user')
            ->plugins([
                KnowledgeBaseUserPlugin::make(),
            ]);
    }
}
