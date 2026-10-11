<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Schemas\SchemasServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
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
            BladeIconsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            FilamentServiceProvider::class,
            ActionsServiceProvider::class,
            FormsServiceProvider::class,
            InfolistsServiceProvider::class,
            NotificationsServiceProvider::class,
            SchemasServiceProvider::class,
            SupportServiceProvider::class,
            TablesServiceProvider::class,
            WidgetsServiceProvider::class,
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
     * checkout is never written to.
     */
    protected function defineDatabaseMigrations(): void
    {
        $migrationsPath = __DIR__.'/../vendor/jeffersongoncalves/laravel-knowledge-base/database/migrations';

        if (is_dir($migrationsPath)) {
            // Copy the stubs in the order the core registers them; loadMigrationsFrom()
            // sorts by filename, so "add_*" would otherwise run before "create_*".
            $orderedPath = sys_get_temp_dir().'/filament-knowledge-base-migrations';

            if (! is_dir($orderedPath)) {
                mkdir($orderedPath, 0777, true);
            }

            foreach ([
                'create_kb_categories_table',
                'create_kb_articles_table',
                'create_kb_article_versions_table',
                'create_kb_article_feedback_table',
                'create_kb_article_relations_table',
                'add_kb_content_localization',
                'add_kb_collections',
            ] as $index => $name) {
                $stub = $migrationsPath.'/'.$name.'.php.stub';

                if (file_exists($stub)) {
                    copy($stub, sprintf('%s/%02d_%s.php', $orderedPath, $index, $name));
                }
            }

            $this->loadMigrationsFrom($orderedPath);
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
