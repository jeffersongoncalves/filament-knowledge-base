<?php

use Filament\Facades\Filament;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\EditArticle;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\RelationManagers\AssetsRelationManager;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\AssetUsage;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
use JeffersonGoncalves\KnowledgeBase\Enums\AssetKind;
use JeffersonGoncalves\KnowledgeBase\Models\Article;
use JeffersonGoncalves\KnowledgeBase\Models\ArticleAsset;
use JeffersonGoncalves\KnowledgeBase\Models\Category;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use JeffersonGoncalves\KnowledgeBase\Support\ArticleAssets;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;

beforeEach(function () {
    config([
        'knowledge-base.locales' => ['en', 'de'],
        'knowledge-base.default_locale' => 'en',
        'knowledge-base.attachments' => [
            'disk' => 'public',
            'directory' => 'knowledge-base',
            'images' => ['accepted_types' => ['image/jpeg', 'image/png', 'image/webp'], 'max_size' => 5120],
            'files' => ['accepted_types' => ['application/pdf'], 'max_size' => 10240],
        ],
    ]);

    Storage::fake('public');

    User::createTable();
    Filament::setCurrentPanel(Filament::getPanel('admin'));

    $user = User::create(['name' => 'Editor', 'email' => 'editor@example.com']);
    $category = Category::create(['name' => 'Plant care', 'slug' => 'plant-care', 'visibility' => 'public']);

    /** @var Article $article */
    $article = app(KnowledgeBaseService::class)->createArticle([
        'category_id' => $category->id,
        'title' => 'Fern leaf care',
        'slug' => 'fern-leaf-care',
        'content' => 'How to care for a fern.',
        'visibility' => 'public',
    ], $user);

    $this->article = $article;
    $this->assets = app(ArticleAssets::class);
});

function managerImage(Article $article, string $name, ?string $locale = null): ArticleAsset
{
    $asset = test()->assets->store($article, UploadedFile::fake()->image($name), AssetKind::Image, $locale);

    return ArticleAsset::where('uuid', $asset->getAttribute('uuid'))->firstOrFail();
}

function manager(Article $article): Testable
{
    return Livewire::test(AssetsRelationManager::class, [
        'ownerRecord' => $article,
        'pageClass' => EditArticle::class,
    ]);
}

it('shows the article\'s assets with their scope and usage', function () {
    $shared = managerImage($this->article, 'fern.jpg');
    $german = managerImage($this->article, 'farn.jpg', 'de');

    manager($this->article)
        ->assertOk()
        ->assertCanSeeTableRecords([$shared, $german])
        ->assertSee('Shared')
        ->assertSee('DE')
        ->assertSee('Unused');
});

it('reports where an asset is used', function () {
    $shared = managerImage($this->article, 'fern.jpg');

    $this->article->translation('en')->update([
        'content' => '<img data-id="'.$shared->getAttribute('uuid').'" src="/x.jpg">',
    ]);

    $this->article->translations()->create([
        'locale' => 'de',
        'title' => 'Farnpflege',
        'slug' => 'farnpflege',
        'content' => '<img data-id="'.$shared->getAttribute('uuid').'" src="/x.jpg">',
    ]);

    expect(AssetUsage::usageLabel($shared->fresh()))->toBe('Used in EN, DE');
});

it('names the languages that still use an asset when deleting it', function () {
    $german = managerImage($this->article, 'farn.jpg', 'de');

    $this->article->translations()->create([
        'locale' => 'de',
        'title' => 'Farnpflege',
        'slug' => 'farnpflege',
        'content' => '<img data-id="'.$german->getAttribute('uuid').'" src="/x.jpg">',
    ]);

    manager($this->article)
        ->mountTableAction('delete', $german)
        ->assertSee('DE');
});

it('uploads a new asset with a chosen kind and scope', function () {
    manager($this->article)
        ->callTableAction('upload', null, [
            'file' => UploadedFile::fake()->image('fern.jpg'),
            'kind' => AssetKind::Image->value,
            'scope' => 'de',
        ])
        ->assertHasNoTableActionErrors();

    $asset = ArticleAsset::query()->firstOrFail();

    expect($asset->isShared())->toBeFalse()
        ->and($asset->getAttribute('locale'))->toBe('de')
        ->and($asset->getAttribute('article_id'))->toBe($this->article->id);
});

it('offers shared and every non-default language as a scope', function () {
    expect(AssetUsage::scopeOptions())->toBe(['shared' => 'Shared', 'de' => 'DE']);
});

it('removes the file from disk when an asset is deleted', function () {
    $image = managerImage($this->article, 'fern.jpg');
    $path = $image->getAttribute('path');

    Storage::disk('public')->assertExists($path);

    manager($this->article)
        ->callTableAction('delete', $image)
        ->assertHasNoTableActionErrors();

    expect(ArticleAsset::query()->count())->toBe(0);
    Storage::disk('public')->assertMissing($path);
});
