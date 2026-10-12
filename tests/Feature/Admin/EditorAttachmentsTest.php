<?php

use Filament\Facades\Filament;
use Filament\Forms\Components\RichEditor;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\Pages\CreateArticle;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\Pages\EditArticle;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\AssetUsage;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ContentAttachments;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
use JeffersonGoncalves\KnowledgeBase\Enums\AssetKind;
use JeffersonGoncalves\KnowledgeBase\Models\Article;
use JeffersonGoncalves\KnowledgeBase\Models\ArticleAsset;
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
});

it('stores a file dropped into a language tab as an asset of that language', function () {
    Livewire::test(EditArticle::class, ['record' => $this->article->getRouteKey()])
        ->set('componentFileAttachments.data.translations.de.content', UploadedFile::fake()->image('farn.jpg'))
        ->call('getFormComponentFileAttachmentUrl', 'data.translations.de.content')
        ->assertDispatched(ContentAttachments::ASSETS_CHANGED_EVENT);

    $asset = ArticleAsset::query()->firstOrFail();

    expect($asset->getAttribute('article_id'))->toBe($this->article->id)
        ->and($asset->getAttribute('locale'))->toBe('de')
        ->and($asset->getAttribute('path'))->toStartWith('knowledge-base/articles/');
});

it('gives the article\'s images their asset id on save, so their usage is known', function () {
    $asset = app(ArticleAssets::class)->store($this->article, UploadedFile::fake()->image('fern.jpg'), AssetKind::Image);
    $url = app(ArticleAssets::class)->url($asset);

    Livewire::test(EditArticle::class, ['record' => $this->article->getRouteKey()])
        ->fillForm([
            'translations' => [
                'en' => [
                    'title' => 'Fern leaf care',
                    'slug' => 'fern-leaf-care',
                    'content' => '<p>Look:</p><figure data-trix-attachment="{}"><img src="'.$url.'" width="10"></figure><img src="https://elsewhere.test/a.jpg">',
                ],
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $content = (string) $this->article->fresh()->content;

    expect($content)->toContain('<img data-id="'.$asset->getAttribute('uuid').'" src="'.$url.'"')
        ->and($content)->toContain('<img src="https://elsewhere.test/a.jpg">')
        ->and(AssetUsage::usageLabel($asset))->toBe('Used in EN');
});

it('leaves an image that already has its id alone', function () {
    $html = '<img data-id="kept" src="/storage/knowledge-base/x.jpg">';

    expect(ContentAttachments::tagImages($html, $this->article))->toBe($html);
});

it('keeps the attach button off the create page and explains why', function () {
    $hasAttachButton = fn (RichEditor $field): bool => in_array('attachFiles', $field->getToolbarButtons(), true);

    Livewire::test(CreateArticle::class)
        ->assertSee('Add images and files after saving')
        ->assertFormFieldExists('translations.en.content', fn (RichEditor $field): bool => ! $hasAttachButton($field));

    Livewire::test(EditArticle::class, ['record' => $this->article->getRouteKey()])
        ->assertDontSee('Add images and files after saving')
        ->assertFormFieldExists('translations.de.content', fn (RichEditor $field): bool => $hasAttachButton($field)
            && $field->getFileAttachmentsDiskName() === 'public'
            && $field->getFileAttachmentsDirectory() === 'knowledge-base');
});

it('gives an image its asset id when its URL is one the core serves', function () {
    $asset = app(ArticleAssets::class)->store($this->article, UploadedFile::fake()->image('fern.jpg'), AssetKind::Image);
    $served = 'http://localhost/knowledge-base/assets/'.$asset->getAttribute('uuid').'/fern.jpg?expires=1&amp;signature=abc';

    expect(ContentAttachments::tagImages('<img src="'.$served.'">', $this->article))
        ->toBe('<img data-id="'.$asset->getAttribute('uuid').'" src="'.$served.'">');
});

it('points images and Trix attachments at their current URL when the editor loads', function () {
    $asset = app(ArticleAssets::class)->store($this->article, UploadedFile::fake()->image('fern.jpg'), AssetKind::Image);
    $stale = 'https://old.example.com/knowledge-base/assets/'.$asset->getAttribute('uuid').'/fern.jpg?expires=1&signature=abc';
    $current = app(ArticleAssets::class)->url($asset);
    $attachment = e((string) json_encode(['contentType' => 'image/jpeg', 'url' => $stale, 'href' => $stale], JSON_UNESCAPED_SLASHES));

    $this->article->update([
        'content' => '<figure data-trix-attachment="'.$attachment.'"><img data-id="'.$asset->getAttribute('uuid').'" src="'.e($stale).'"></figure>'
            .'<figure data-trix-attachment="{&quot;url&quot;:&quot;https://elsewhere.test/a.jpg&quot;}"><img src="https://elsewhere.test/a.jpg"></figure>',
    ]);

    $content = (string) Livewire::test(EditArticle::class, ['record' => $this->article->getRouteKey()])
        ->get('data.translations.en.content');

    expect($content)->not->toContain('old.example.com')
        ->and($content)->toContain('src="'.e($current).'"')
        ->and(html_entity_decode($content))->toContain('"url":"'.$current.'"')
        ->and(html_entity_decode($content))->toContain('"href":"'.$current.'"')
        ->and(html_entity_decode($content))->toContain('"url":"https://elsewhere.test/a.jpg"');
});
