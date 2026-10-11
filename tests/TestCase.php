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

    /**
     * Load the core package's migrations in dependency order.
     *
     * Alphabetical order is not enough: `add_kb_content_localization` sorts
     * before the `create_kb_*` tables it alters, and `kb_article_versions`
     * sorts before the `kb_articles` it references. The package ships the
     * migrations as `.php.stub`; copy them into a temp directory with an
     * ordered filename prefix (the same order as the core package's own
     * `KnowledgeBaseServiceProvider::hasMigrations()`), so the symlinked core
     * checkout is never written to. Migrations a given core release does not
     * ship (an older release without content localization) are simply skipped.
     */
    protected function defineDatabaseMigrations(): void
    {
        $migrationsPath = __DIR__.'/../vendor/jeffersongoncalves/laravel-knowledge-base/database/migrations';

        if (! is_dir($migrationsPath)) {
            return;
        }

        $order = [
            'create_kb_categories_table',
            'create_kb_articles_table',
            'create_kb_article_versions_table',
            'create_kb_article_feedback_table',
            'create_kb_article_relations_table',
            'add_kb_content_localization',
            'add_kb_collections',
        ];

        $tempPath = sys_get_temp_dir().'/filament-panel-fix-migrations';

        if (! is_dir($tempPath)) {
            mkdir($tempPath, 0755, true);
        }

        foreach ($order as $index => $name) {
            $stub = $migrationsPath.'/'.$name.'.php.stub';

            if (is_file($stub)) {
                copy($stub, $tempPath.'/'.sprintf('%03d_%s.php', $index, $name));
            }
        }

        $this->loadMigrationsFrom($tempPath);
    }
}
