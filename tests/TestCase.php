<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Tests;

use Filament\FilamentServiceProvider;
use Filament\Support\SupportServiceProvider;
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
            SupportServiceProvider::class,
            FilamentServiceProvider::class,
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
    }
}
