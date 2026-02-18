<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Tests;

use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Schemas\SchemasServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JeffersonGoncalves\FilamentKnowledgeBase\FilamentKnowledgeBaseServiceProvider;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\TestPanelProvider;
use JeffersonGoncalves\KnowledgeBase\KnowledgeBaseServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            FilamentServiceProvider::class,
            FormsServiceProvider::class,
            SchemasServiceProvider::class,
            SupportServiceProvider::class,
            TablesServiceProvider::class,
            KnowledgeBaseServiceProvider::class,
            TestPanelProvider::class,
            FilamentKnowledgeBaseServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));

        $kbConfig = __DIR__.'/../vendor/jeffersongoncalves/laravel-knowledge-base/config/knowledge-base.php';

        if (file_exists($kbConfig)) {
            $app['config']->set('knowledge-base', require $kbConfig);
        }
    }

    protected function defineDatabaseMigrations(): void
    {
        $migrationsPath = __DIR__.'/../vendor/jeffersongoncalves/laravel-knowledge-base/database/migrations';

        if (is_dir($migrationsPath)) {
            foreach (glob($migrationsPath.'/*.php.stub') as $stub) {
                $migrationPath = str_replace('.php.stub', '.php', $stub);

                if (! file_exists($migrationPath)) {
                    copy($stub, $migrationPath);
                }
            }

            $this->loadMigrationsFrom($migrationsPath);
        }
    }
}
