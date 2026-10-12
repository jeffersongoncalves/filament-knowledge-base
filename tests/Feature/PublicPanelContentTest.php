<?php

use Filament\Facades\Filament;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\ArticleResource\Pages\ViewArticle as GuestViewArticle;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ContentAttachments;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
use JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\ArticleResource\Pages\ViewArticle as UserViewArticle;
use JeffersonGoncalves\KnowledgeBase\Enums\AssetKind;
use JeffersonGoncalves\KnowledgeBase\Models\Article;
use JeffersonGoncalves\KnowledgeBase\Models\Category;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use JeffersonGoncalves\KnowledgeBase\Support\ArticleAssets;
use Livewire\Livewire;

/**
 * Customers read articles in the Guest and User panels too, so asset
 * references there point at their current URLs and deleted assets are left
 * out, as on any public page.
 */
beforeEach(function () {
    config([
        'knowledge-base.locales' => ['en', 'de'],
        'knowledge-base.default_locale' => 'en',
    ]);

    Storage::fake((string) config('knowledge-base.attachments.disk'));

    User::createTable();
    $this->actingAs($user = User::create(['name' => 'Reader', 'email' => 'reader@example.com']));
    $this->assets = app(ArticleAssets::class);

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
    $this->kept = $this->assets->store($article, UploadedFile::fake()->image('fern.jpg'), AssetKind::Image);
    $this->deleted = $this->assets->store($article, UploadedFile::fake()->image('old.jpg'), AssetKind::Image);

    $image = fn ($asset, string $src): string => '<p><img data-id="'.$asset->getAttribute('uuid').'" src="'.$src.'" alt=""></p>';

    $article->update([
        'content' => '<p>How to care for a fern.</p>'
            .$image($this->kept, 'https://old.example.com/expired.jpg')
            .$image($this->deleted, 'https://old.example.com/deleted.jpg'),
    ]);

    $this->assets->delete($this->deleted);
});

it('shows customers current asset URLs and leaves out deleted assets', function (string $panel, string $page) {
    Filament::setCurrentPanel(Filament::getPanel($panel));

    Livewire::test($page, ['record' => $this->article->getRouteKey()])
        ->assertOk()
        ->assertSee('How to care for a fern.')
        ->assertSeeHtml('src="'.e($this->assets->url($this->kept)).'"')
        ->assertDontSeeHtml('old.example.com')
        ->assertDontSeeHtml($this->deleted->getAttribute('uuid'));
})->with([
    'guest panel' => ['guest', GuestViewArticle::class],
    'user panel' => ['user', UserViewArticle::class],
]);

it('leaves content that is not an article untouched', function () {
    expect(ContentAttachments::displayContent('<p>Plain</p>', null))->toBe('<p>Plain</p>');
});
