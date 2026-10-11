<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentKnowledgeBaseServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-knowledge-base';

    public static string $viewNamespace = 'filament-knowledge-base';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasViews(static::$viewNamespace)
            ->hasTranslations();
    }

    public function packageBooted(): void
    {
        // Published to public/ by `php artisan filament:assets` (also run by
        // `filament:upgrade`), and loaded on every panel.
        FilamentAsset::register([
            Css::make('language-tabs', __DIR__.'/../resources/dist/language-tabs.css'),
        ], 'jeffersongoncalves/filament-knowledge-base');
    }
}
