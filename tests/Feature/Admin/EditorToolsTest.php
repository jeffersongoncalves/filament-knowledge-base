<?php

use Filament\Actions\Testing\TestAction;
use Filament\Facades\Filament;
use Filament\Forms\Components\RichEditor;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\EditArticle;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\RichEditor\Actions\AttachFileAction;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\RichEditor\Actions\InsertImageAction;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ContentAttachments;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
use JeffersonGoncalves\KnowledgeBase\Models\Article;
use JeffersonGoncalves\KnowledgeBase\Models\ArticleAsset;
use JeffersonGoncalves\KnowledgeBase\Models\Category;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
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
});

function editorFor(Article $article, string $statePath): RichEditor
{
    return RichEditor::make('content')->model($article)->statePath($statePath);
}

function editorImage(Article $article, string $name = 'fern.jpg', ?string $locale = null): ArticleAsset
{
    $uuid = ContentAttachments::store(editorFor($article, 'content'), UploadedFile::fake()->image($name));
    $asset = ArticleAsset::where('uuid', $uuid)->firstOrFail();

    if ($locale !== null) {
        $asset->update(['locale' => $locale]);
    }

    return $asset;
}

it('replaces the paperclip with the image and file tools', function () {
    Livewire::test(EditArticle::class, ['record' => $this->article->getRouteKey()])
        ->assertFormFieldExists('translations.en.content', fn (RichEditor $field): bool => ! $field->hasToolbarButton('attachFiles')
            && $field->hasToolbarButton(InsertImageAction::NAME)
            && $field->hasToolbarButton(AttachFileAction::NAME)
            && $field->hasAction(InsertImageAction::NAME)
            && $field->hasAction(AttachFileAction::NAME));
});

it('offers the shared images and the tab language images for reuse', function () {
    $shared = editorImage($this->article, 'shared.jpg');
    $german = editorImage($this->article, 'farn.jpg', 'de');
    $english = editorImage($this->article, 'english.jpg', 'en');

    $germanChoices = ContentAttachments::imageChoices(editorFor($this->article, 'translations.de.content'));
    $englishChoices = ContentAttachments::imageChoices(editorFor($this->article, 'translations.en.content'));

    expect(array_keys($germanChoices))->toContain((string) $shared->getAttribute('uuid'))
        ->and(array_keys($germanChoices))->toContain((string) $german->getAttribute('uuid'))
        ->and(array_keys($englishChoices))->toContain((string) $shared->getAttribute('uuid'))
        ->and(array_keys($englishChoices))->not->toContain((string) $german->getAttribute('uuid'))
        ->and(array_keys($germanChoices))->not->toContain((string) $english->getAttribute('uuid'));
});

it('offers only the article\'s own assets', function () {
    $other = app(KnowledgeBaseService::class)->createArticle([
        'category_id' => $this->article->category_id,
        'title' => 'Other article',
        'slug' => 'other-article',
        'content' => 'Other.',
        'visibility' => 'public',
    ], User::first());

    $foreign = editorImage($other, 'foreign.jpg');

    $choices = ContentAttachments::imageChoices(editorFor($this->article, 'content'));

    expect(array_keys($choices))->not->toContain((string) $foreign->getAttribute('uuid'));
});

it('lists files for the attach tool separately from images', function () {
    editorImage($this->article, 'fern.jpg');

    $editor = editorFor($this->article, 'content');
    $uuid = ContentAttachments::store($editor, UploadedFile::fake()->createWithContent('warranty.pdf', "%PDF-1.4\ntrailer<</Root 1 0 R>>\n%%EOF"));

    expect(ContentAttachments::fileChoices($editor))->toHaveKey($uuid)
        ->and(ContentAttachments::imageChoices($editor))->not->toHaveKey($uuid);
});

it('accepts only the configured image and file types', function () {
    expect(ContentAttachments::imageTypes())->toBe(['image/jpeg', 'image/png', 'image/webp'])
        ->and(ContentAttachments::fileTypes())->toBe(['application/pdf'])
        ->and(ContentAttachments::imageTypes())->not->toContain('application/pdf');
});

it('inserts an existing image without uploading it again', function () {
    $this->actingAs(User::first());
    $shared = editorImage($this->article);

    Livewire::test(EditArticle::class, ['record' => $this->article->getRouteKey()])
        ->callAction(
            TestAction::make(InsertImageAction::NAME)->schemaComponent('translations.de.content', schema: 'form'),
            data: ['existing' => $shared->uuid, 'alt' => 'A fern leaf'],
            arguments: ['editorSelection' => ['type' => 'text', 'anchor' => 1, 'head' => 1]],
        )
        ->assertHasNoActionErrors();

    expect(ArticleAsset::count())->toBe(1);
});

it('attaches an existing file without uploading it again', function () {
    $this->actingAs(User::first());
    $guide = ArticleAsset::where('uuid', ContentAttachments::store(
        editorFor($this->article, 'content'),
        UploadedFile::fake()->create('care-guide.pdf', 20, 'application/pdf'),
    ))->firstOrFail();

    Livewire::test(EditArticle::class, ['record' => $this->article->getRouteKey()])
        ->callAction(
            TestAction::make(AttachFileAction::NAME)->schemaComponent('translations.de.content', schema: 'form'),
            data: ['existing' => $guide->uuid],
            arguments: ['editorSelection' => ['type' => 'text', 'anchor' => 1, 'head' => 1]],
        )
        ->assertHasNoActionErrors();

    expect(ArticleAsset::count())->toBe(1);
});
