<?php

use Filament\Facades\Filament;
use Filament\Forms\Components\RichEditor;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ContentAttachments;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
use JeffersonGoncalves\KnowledgeBase\Enums\AssetKind;
use JeffersonGoncalves\KnowledgeBase\Models\Article;
use JeffersonGoncalves\KnowledgeBase\Models\ArticleAsset;
use JeffersonGoncalves\KnowledgeBase\Models\Category;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use JeffersonGoncalves\KnowledgeBase\Support\ArticleAssets;

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
});

function tabEditor(Article $article, string $statePath): RichEditor
{
    return RichEditor::make('content')->model($article)->statePath($statePath);
}

it('stores an upload in the default language tab as a shared asset', function () {
    $uuid = ContentAttachments::store(tabEditor($this->article, 'translations.en.content'), UploadedFile::fake()->image('fern.jpg'));

    /** @var ArticleAsset $asset */
    $asset = ArticleAsset::where('uuid', $uuid)->firstOrFail();

    expect($asset->isShared())->toBeTrue()
        ->and($asset->getAttribute('article_id'))->toBe($this->article->id)
        ->and($asset->kind())->toBe(AssetKind::Image)
        ->and($asset->getAttribute('path'))->toContain('/shared/');
});

it('stores an upload in a translation tab as an asset of that language', function () {
    $uuid = ContentAttachments::store(tabEditor($this->article, 'translations.de.content'), UploadedFile::fake()->image('farn.jpg'));

    $asset = ArticleAsset::where('uuid', $uuid)->firstOrFail();

    expect($asset->isShared())->toBeFalse()
        ->and($asset->getAttribute('locale'))->toBe('de')
        ->and($asset->getAttribute('path'))->toContain('/de/');
});

it('stores an upload from the single-language form as shared', function () {
    $uuid = ContentAttachments::store(tabEditor($this->article, 'content'), UploadedFile::fake()->image('fern.jpg'));

    expect(ArticleAsset::where('uuid', $uuid)->firstOrFail()->isShared())->toBeTrue();
});

it('reads the scope from the state path', function () {
    expect(ContentAttachments::localeForStatePath('data.translations.de.content'))->toBe('de')
        ->and(ContentAttachments::localeForStatePath('translations.en.content'))->toBe('en')
        ->and(ContentAttachments::localeForStatePath('content'))->toBeNull()
        ->and(ContentAttachments::localeForStatePath('translations.it.content'))->toBeNull();
});

it('tells images and files apart by their detected type', function () {
    expect(ContentAttachments::kindFor('image/png'))->toBe(AssetKind::Image)
        ->and(ContentAttachments::kindFor('application/pdf'))->toBe(AssetKind::File);
});

it('shows the current asset URL and follows the site address', function () {
    $uuid = (string) ContentAttachments::store(tabEditor($this->article, 'content'), UploadedFile::fake()->image('fern.jpg'));

    /** @var ArticleAsset $asset */
    $asset = ArticleAsset::where('uuid', $uuid)->firstOrFail();

    expect(ContentAttachments::url($uuid))->toBe(app(ArticleAssets::class)->url($asset));

    config(['filesystems.disks.public.url' => 'https://first.test/storage']);
    Storage::forgetDisk('public');
    expect(ContentAttachments::url($uuid))->toContain('first.test');

    config(['filesystems.disks.public.url' => 'https://second.test/storage']);
    Storage::forgetDisk('public');
    expect(ContentAttachments::url($uuid))->toContain('second.test');
});

it('returns null for an unknown asset uuid', function () {
    expect(ContentAttachments::url('00000000-0000-0000-0000-000000000000'))->toBeNull()
        ->and(ContentAttachments::url(null))->toBeNull();
});
