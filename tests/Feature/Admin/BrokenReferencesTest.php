<?php

use Filament\Facades\Filament;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\EditArticle;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\ListArticles;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\BrokenReferences;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
use JeffersonGoncalves\KnowledgeBase\Enums\AssetKind;
use JeffersonGoncalves\KnowledgeBase\Models\Article;
use JeffersonGoncalves\KnowledgeBase\Models\Category;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use JeffersonGoncalves\KnowledgeBase\Support\ArticleAssets;
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
    $this->actingAs(User::create(['name' => 'Editor', 'email' => 'editor@example.com']));

    $category = Category::create(['name' => 'Plant care', 'slug' => 'plant-care', 'visibility' => 'public']);

    /** @var Article $article */
    $article = app(KnowledgeBaseService::class)->createArticle([
        'category_id' => $category->id,
        'title' => 'Fern leaf care',
        'slug' => 'fern-leaf-care',
        'content' => 'How to care for a fern.',
        'visibility' => 'public',
    ], User::first());

    $this->article = $article;
    $this->assets = app(ArticleAssets::class);
});

function breakGermanImage(Article $article): string
{
    $asset = test()->assets->store($article, UploadedFile::fake()->image('farn.jpg'), AssetKind::Image, 'de');
    $uuid = (string) $asset->getAttribute('uuid');

    $article->translations()->create([
        'locale' => 'de',
        'title' => 'Farnpflege',
        'slug' => 'farnpflege',
        'content' => '<img data-id="'.$uuid.'" src="/x.jpg">',
    ]);

    test()->assets->delete($asset);

    return $uuid;
}

it('warns on the edit page while content refers to a deleted asset', function () {
    breakGermanImage($this->article);

    Livewire::test(EditArticle::class, ['record' => $this->article->getRouteKey()])
        ->assertOk()
        ->assertSee('Content refers to missing assets')
        ->assertSee('DE: 1 deleted image');
});

it('describes a deleted image in plain words, never by an internal id', function () {
    $uuid = breakGermanImage($this->article);

    expect(BrokenReferences::message($this->article->fresh()))
        ->toContain('DE: 1 deleted image')
        ->not->toContain($uuid);
});

it('clears the edit-page warning once the reference is removed', function () {
    breakGermanImage($this->article);

    $this->article->translation('de')->update(['content' => '<p>No image any more.</p>']);

    Livewire::test(EditArticle::class, ['record' => $this->article->getRouteKey()])
        ->assertOk()
        ->assertDontSee('Content refers to missing assets');
});

it('marks the article in the list while a reference is broken', function () {
    Livewire::test(ListArticles::class)
        ->assertOk()
        ->assertDontSee('Missing asset');

    breakGermanImage($this->article);

    Livewire::test(ListArticles::class)
        ->assertOk()
        ->assertSee('Missing asset');
});
