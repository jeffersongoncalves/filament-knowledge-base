<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase;

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
}
