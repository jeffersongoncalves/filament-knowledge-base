<?php

use Filament\Facades\Filament;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\EditArticle;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\ViewArticle;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBasePlugin;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
use JeffersonGoncalves\KnowledgeBase\Models\Article;
use JeffersonGoncalves\KnowledgeBase\Models\Category;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use Livewire\Livewire;

beforeEach(function () {
    config([
        'knowledge-base.locales' => ['en', 'de'],
        'knowledge-base.default_locale' => 'en',
    ]);

    User::createTable();
    Filament::setCurrentPanel(Filament::getPanel('admin'));
    $this->actingAs($user = User::create(['name' => 'Editor', 'email' => 'editor@example.com']));

    $category = Category::create(['name' => 'Plant care', 'slug' => 'plant-care', 'visibility' => 'public']);
    $service = app(KnowledgeBaseService::class);

    /** @var Article $article */
    $article = $service->publishArticle($service->createArticle([
        'category_id' => $category->id,
        'title' => 'Fern leaf care',
        'slug' => 'fern-leaf-care',
        'content' => '<p>How to care for a fern.</p>',
        'visibility' => 'public',
    ], $user));

    $this->article = $article;
});

it('shows the article first and its details in a tab next to the related data', function () {
    Livewire::test(ViewArticle::class, ['record' => $this->article->getRouteKey()])
        ->assertOk()
        ->assertSeeInOrder(['How to care for a fern.', 'About this article', 'Details', 'Assets', 'Versions'])
        ->assertSee('Published');
});

it('opens the article on the public site in a new tab, per language', function () {
    KnowledgeBasePlugin::get()->publicUrlUsing(
        fn (Article $article, string $locale): string => "https://shop.example/{$locale}/help/articles/{$article->slug}",
    );

    Livewire::test(ViewArticle::class, ['record' => $this->article->getRouteKey()])
        ->assertActionVisible('viewOnSiteDe')
        ->assertActionHasUrl('viewOnSiteDe', 'https://shop.example/de/help/articles/fern-leaf-care')
        ->assertActionShouldOpenUrlInNewTab('viewOnSiteDe');

    Livewire::test(EditArticle::class, ['record' => $this->article->getRouteKey()])
        ->assertActionHasUrl('viewOnSiteEn', 'https://shop.example/en/help/articles/fern-leaf-care');
});

it('offers no public link for an internal article or without a configured URL', function () {
    Livewire::test(ViewArticle::class, ['record' => $this->article->getRouteKey()])
        ->assertActionHidden('viewOnSiteEn');

    KnowledgeBasePlugin::get()->publicUrlUsing(fn (Article $article, string $locale): string => 'https://shop.example');
    $this->article->update(['visibility' => 'internal']);

    Livewire::test(ViewArticle::class, ['record' => $this->article->getRouteKey()])
        ->assertActionHidden('viewOnSiteEn');
});
