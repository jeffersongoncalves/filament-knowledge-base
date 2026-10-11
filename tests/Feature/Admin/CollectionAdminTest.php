<?php

use Filament\Facades\Filament;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\CollectionResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\Pages\CreateCollection;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\Pages\EditCollection;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
use JeffersonGoncalves\KnowledgeBase\Models\Article;
use JeffersonGoncalves\KnowledgeBase\Models\Category;
use JeffersonGoncalves\KnowledgeBase\Models\Collection;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use Livewire\Livewire;

beforeEach(function () {
    if (! TranslationForm::coreSupportsLocalization()) {
        $this->markTestSkipped('Needs a laravel-knowledge-base release with content localization.');
    }

    config([
        'knowledge-base.locales' => ['en', 'de'],
        'knowledge-base.default_locale' => 'en',
        'knowledge-base.missing_translation' => 'fallback',
    ]);

    User::createTable();

    Filament::setCurrentPanel(Filament::getPanel('admin'));

    $this->user = User::create(['name' => 'Editor', 'email' => 'editor@example.com']);
    $this->actingAs($this->user);

    $this->service = app(KnowledgeBaseService::class);
    $this->public = $this->service->createCategory(['name' => 'Billing', 'slug' => 'billing']);
    $this->internal = $this->service->createCategory(['name' => 'Internal procedures', 'slug' => 'internal-procedures', 'visibility' => 'internal']);
});

function collectionAdminArticle(Category $category, string $title, array $overrides = []): Article
{
    $article = test()->service->createArticle(array_merge([
        'category_id' => $category->id,
        'title' => $title,
        'content' => 'Content.',
        'visibility' => 'public',
    ], $overrides), test()->user);

    return test()->service->publishArticle($article);
}

it('resolves the collection model', function () {
    expect(CollectionResource::getModel())->toBe(Collection::class);
});

it('creates a collection with an English and a German version', function () {
    Livewire::test(CreateCollection::class)
        ->fillForm([
            'is_active' => true,
            'translations' => [
                'en' => [
                    'name' => 'Frequently asked questions',
                    'slug' => 'frequently-asked-questions',
                    'description' => 'The FAQ.',
                ],
                'de' => [
                    'name' => 'Häufige Fragen',
                    'slug' => 'haeufige-fragen',
                    'description' => 'De FAQ.',
                ],
            ],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $collection = Collection::where('slug', 'frequently-asked-questions')->firstOrFail();

    expect($collection->translation('en')->name)->toBe('Frequently asked questions')
        ->and($collection->translation('de')->name)->toBe('Häufige Fragen')
        ->and($collection->is_active)->toBeTrue();
});

it('shows a form error instead of failing when a language tab uses a slug of another collection', function () {
    Collection::create(['name' => 'FAQ', 'slug' => 'faq']);

    Livewire::test(CreateCollection::class)
        ->fillForm([
            'translations' => [
                'en' => ['name' => 'Getting started', 'slug' => 'getting-started'],
                'de' => ['name' => 'Aan de slag', 'slug' => 'faq'],
            ],
        ])
        ->call('create')
        ->assertHasFormErrors(['translations.de.slug']);

    expect(Collection::where('slug', 'getting-started')->exists())->toBeFalse();
});

it('requires a name and slug on a partly filled language tab', function () {
    Livewire::test(CreateCollection::class)
        ->fillForm([
            'translations' => [
                'en' => ['name' => 'FAQ', 'slug' => 'faq'],
                'de' => ['description' => 'Nur eine Beschreibung.'],
            ],
        ])
        ->call('create')
        ->assertHasFormErrors(['translations.de.name' => 'required', 'translations.de.slug' => 'required']);

    expect(Collection::where('slug', 'faq')->exists())->toBeFalse();
});

it('does not accept the same article twice', function () {
    $article = collectionAdminArticle($this->public, 'How do I pay?');

    Livewire::test(CreateCollection::class)
        ->fillForm([
            'translations' => ['en' => ['name' => 'FAQ', 'slug' => 'faq']],
            'articles' => [['id' => $article->id], ['id' => $article->id]],
        ])
        ->call('create')
        ->assertHasFormErrors();

    expect(Collection::where('slug', 'faq')->exists())->toBeFalse();
});

it('saves the collection, its versions and its articles in one transaction', function () {
    expect(Livewire::test(CreateCollection::class)->instance()->hasDatabaseTransactions())->toBeTrue();
});

it('keeps the collection form bound to the collection columns with one language', function () {
    config(['knowledge-base.locales' => ['en'], 'knowledge-base.default_locale' => 'en']);

    $collection = Collection::create(['name' => 'FAQ', 'slug' => 'faq']);

    Livewire::test(EditCollection::class, ['record' => $collection->getRouteKey()])
        ->fillForm(['name' => 'FAQ (edited)'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($collection->fresh()->name)->toBe('FAQ (edited)');
});

it('stores the articles in the order the editor left them', function () {
    $a = collectionAdminArticle($this->public, 'Article A');
    $b = collectionAdminArticle($this->public, 'Article B');
    $c = collectionAdminArticle($this->public, 'Article C');

    $collection = Collection::create(['name' => 'FAQ', 'slug' => 'faq']);
    $collection->addArticle($a);
    $collection->addArticle($b);
    $collection->addArticle($c);

    Livewire::test(EditCollection::class, ['record' => $collection->getRouteKey()])
        ->fillForm([
            'articles' => [
                ['id' => $c->id],
                ['id' => $a->id],
                ['id' => $b->id],
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($collection->fresh()->articleIds())->toBe([$c->id, $a->id, $b->id]);
});

it('removes an article that is no longer in the list', function () {
    $a = collectionAdminArticle($this->public, 'Article A');
    $b = collectionAdminArticle($this->public, 'Article B');

    $collection = Collection::create(['name' => 'FAQ', 'slug' => 'faq']);
    $collection->addArticle($a);
    $collection->addArticle($b);

    Livewire::test(EditCollection::class, ['record' => $collection->getRouteKey()])
        ->fillForm(['articles' => [['id' => $a->id]]])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($collection->fresh()->articleIds())->toBe([$a->id])
        ->and(Article::find($b->id))->not->toBeNull();
});

it('warns when a collection holds an article in an internal category', function () {
    $internalArticle = collectionAdminArticle($this->internal, 'Internal checklist');

    $collection = Collection::create(['name' => 'FAQ', 'slug' => 'faq']);
    $collection->addArticle($internalArticle);

    Livewire::test(EditCollection::class, ['record' => $collection->getRouteKey()])
        ->assertOk()
        ->assertSee(__('filament-knowledge-base::knowledge-base.admin.collections.warnings.internal_category'));
});

it('does not warn about a customer-visible article', function () {
    $visible = collectionAdminArticle($this->public, 'Public article');

    $collection = Collection::create(['name' => 'FAQ', 'slug' => 'faq']);
    $collection->addArticle($visible);

    Livewire::test(EditCollection::class, ['record' => $collection->getRouteKey()])
        ->assertOk()
        ->assertDontSee(__('filament-knowledge-base::knowledge-base.admin.collections.warnings.internal_category'))
        ->assertDontSee(__('filament-knowledge-base::knowledge-base.admin.collections.warnings.internal_article'));
});
