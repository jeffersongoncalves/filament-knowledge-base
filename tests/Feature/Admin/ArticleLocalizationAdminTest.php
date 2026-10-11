<?php

use Filament\Facades\Filament;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\Facades\DB;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\CreateArticle;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\EditArticle;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\ListArticles;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\LocalizationState;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
use JeffersonGoncalves\KnowledgeBase\Enums\TranslationStatus;
use JeffersonGoncalves\KnowledgeBase\Models\Article;
use JeffersonGoncalves\KnowledgeBase\Models\Category;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use Livewire\Features\SupportTesting\Testable;
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

    $this->actingAs(User::create(['name' => 'Editor', 'email' => 'editor@example.com']));

    $this->service = app(KnowledgeBaseService::class);
    $this->category = Category::create(['name' => 'Account', 'slug' => 'account', 'visibility' => 'public']);
    $this->article = $this->service->createArticle([
        'category_id' => $this->category->id,
        'title' => 'Password reset',
        'slug' => 'password-reset',
        'content' => 'How to apply.',
        'visibility' => 'public',
    ], User::first());
});

function editArticle(Article $article): Testable
{
    return Livewire::test(EditArticle::class, ['record' => $article->getRouteKey()]);
}

it('shows a language tab with the state for each configured language', function () {
    editArticle($this->article)
        ->assertOk()
        ->assertSee('EN')
        ->assertSee('DE');
});

it('translates an article when the German tab is filled in', function () {
    editArticle($this->article)
        ->fillForm([
            'translations' => [
                'de' => [
                    'title' => 'Passwort zurücksetzen',
                    'slug' => 'passwort-zuruecksetzen',
                    'content' => 'So setzt du dein Passwort zurück.',
                ],
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $german = $this->article->fresh()->translation('de');

    expect($german)->not->toBeNull()
        ->and($german->title)->toBe('Passwort zurücksetzen')
        ->and($german->article_id)->toBe($this->article->id);
});

it('requires a title and slug on a partly filled language tab', function () {
    editArticle($this->article)
        ->fillForm(['translations' => ['de' => ['excerpt' => 'Nur eine Zusammenfassung.']]])
        ->call('save')
        ->assertHasFormErrors([
            'translations.de.title' => 'required',
            'translations.de.slug' => 'required',
        ]);

    expect($this->article->fresh()->translation('de'))->toBeNull();
});

it('saves the article and its language versions in one transaction', function () {
    expect(editArticle($this->article)->instance()->hasDatabaseTransactions())->toBeTrue()
        ->and(Livewire::test(CreateArticle::class)->instance()->hasDatabaseTransactions())->toBeTrue();
});

it('saves the chosen authoritative language', function () {
    editArticle($this->article)
        ->fillForm([
            'source_locale' => 'de',
            'translations' => [
                'de' => [
                    'title' => 'Passwort zurücksetzen',
                    'slug' => 'passwort-zuruecksetzen',
                    'content' => 'So setzt du dein Passwort zurück.',
                ],
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $article = $this->article->fresh();

    expect($article->source_locale)->toBe('de')
        ->and($article->title)->toBe('Passwort zurücksetzen');
});

it('publishes the German version on its own', function () {
    editArticle($this->article)
        ->fillForm([
            'translations' => [
                'de' => [
                    'title' => 'Passwort zurücksetzen',
                    'slug' => 'passwort-zuruecksetzen',
                    'content' => 'So setzt du dein Passwort zurück.',
                    'status' => TranslationStatus::Published->value,
                ],
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $german = $this->article->fresh()->translation('de');

    expect($german->status)->toBe(TranslationStatus::Published)
        ->and($this->article->fresh()->translation('en')->status)->toBe(TranslationStatus::Draft);
});

it('does not flag other languages on a typo fix', function () {
    $this->article->translations()->create([
        'locale' => 'de',
        'title' => 'Passwort zurücksetzen',
        'slug' => 'passwort-zuruecksetzen',
        'content' => 'So setzt du dein Passwort zurück.',
        'status' => TranslationStatus::Published,
    ]);

    editArticle($this->article)
        ->fillForm([
            'translations' => [
                'en' => ['title' => 'Password reset (fixed)', 'slug' => 'password-reset', 'content' => 'How to apply.'],
                'de' => ['title' => 'Passwort zurücksetzen', 'slug' => 'passwort-zuruecksetzen', 'content' => 'So setzt du dein Passwort zurück.'],
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($this->article->fresh()->translation('de')->isOutdated())->toBeFalse()
        ->and($this->article->fresh()->title)->toBe('Password reset (fixed)');
});

it('flags other languages outdated when the option is ticked', function () {
    $this->article->translations()->create([
        'locale' => 'de',
        'title' => 'Passwort zurücksetzen',
        'slug' => 'passwort-zuruecksetzen',
        'content' => 'So setzt du dein Passwort zurück.',
        'status' => TranslationStatus::Published,
    ]);

    editArticle($this->article)
        ->fillForm([
            'flag_other_locales_outdated' => true,
            'translations' => [
                'en' => ['title' => 'Password reset (changed)', 'slug' => 'password-reset', 'content' => 'How to apply now.'],
                'de' => ['title' => 'Passwort zurücksetzen', 'slug' => 'passwort-zuruecksetzen', 'content' => 'So setzt du dein Passwort zurück.'],
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $german = $this->article->fresh()->translation('de');

    expect($german->isOutdated())->toBeTrue()
        ->and(LocalizationState::of($german))->toBe(LocalizationState::OUTDATED);
});

it('lists the localization state per language in the article table', function () {
    $this->article->translations()->create([
        'locale' => 'de',
        'title' => 'Passwort zurücksetzen',
        'slug' => 'passwort-zuruecksetzen',
        'content' => 'So setzt du dein Passwort zurück.',
        'status' => TranslationStatus::Published,
        'is_outdated' => true,
    ]);

    Livewire::test(ListArticles::class)
        ->assertOk()
        ->assertSee(LocalizationState::label(LocalizationState::PUBLISHED))
        ->assertSee(LocalizationState::label(LocalizationState::OUTDATED));
});

it('marks an outdated version up to date through the table action', function () {
    $this->article->translations()->create([
        'locale' => 'de',
        'title' => 'Passwort zurücksetzen',
        'slug' => 'passwort-zuruecksetzen',
        'content' => 'So setzt du dein Passwort zurück.',
        'status' => TranslationStatus::Published,
        'is_outdated' => true,
    ]);

    Livewire::test(ListArticles::class)
        ->callTableAction('mark_up_to_date', $this->article, ['locale' => 'de'])
        ->assertHasNoTableActionErrors();

    expect($this->article->fresh()->translation('de')->isOutdated())->toBeFalse();
});

it('filters articles with an outdated version in a chosen language', function () {
    $outdated = $this->article;
    $outdated->translations()->create([
        'locale' => 'de',
        'title' => 'Passwort zurücksetzen',
        'slug' => 'passwort-zuruecksetzen',
        'content' => 'So setzt du dein Passwort zurück.',
        'status' => TranslationStatus::Published,
        'is_outdated' => true,
    ]);

    $current = $this->service->createArticle([
        'category_id' => $this->category->id,
        'title' => 'Managing your subscription',
        'slug' => 'managing-your-subscription',
        'content' => 'Change or cancel your plan.',
        'visibility' => 'public',
    ], User::first());

    $current->translations()->create([
        'locale' => 'de',
        'title' => 'Abonnement verwalten',
        'slug' => 'abonnement-verwalten',
        'content' => 'Tarif wechseln oder kündigen.',
        'status' => TranslationStatus::Published,
    ]);

    Livewire::test(ListArticles::class)
        ->filterTable('outdated_locale', 'de')
        ->assertCanSeeTableRecords([$outdated])
        ->assertCanNotSeeTableRecords([$current]);
});

it('keeps the article form bound to the article columns with one language', function () {
    config(['knowledge-base.locales' => ['en'], 'knowledge-base.default_locale' => 'en']);

    editArticle($this->article)
        ->fillForm(['title' => 'Password reset (edited)'])
        ->call('save')
        ->assertHasNoFormErrors();

    $article = $this->article->fresh();

    expect($article->title)->toBe('Password reset (edited)')
        ->and($article->translations)->toHaveCount(1);
});

it('does not create a version for an untouched language tab', function () {
    editArticle($this->article)
        ->fillForm([
            'translations' => [
                'en' => ['title' => 'Password reset', 'slug' => 'password-reset', 'content' => 'How to apply.'],
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($this->article->fresh()->translations)->toHaveCount(1);
});

it('creates an article in a chosen authoritative language', function () {
    Livewire::test(CreateArticle::class)
        ->fillForm([
            'source_locale' => 'de',
            'visibility' => 'public',
            'category_id' => $this->category->id,
            'translations' => [
                'de' => [
                    'title' => 'Passwort zurücksetzen',
                    'slug' => 'passwort-zuruecksetzen',
                    'content' => 'So setzt du dein Passwort zurück.',
                ],
            ],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $article = Article::where('slug', 'passwort-zuruecksetzen')->firstOrFail();

    expect($article->source_locale)->toBe('de')
        ->and($article->title)->toBe('Passwort zurücksetzen')
        ->and($article->translation('de'))->not->toBeNull();
});

it('shows a form error instead of failing when a language tab uses a slug of another article', function () {
    $other = $this->service->createArticle([
        'category_id' => $this->category->id,
        'title' => 'Billing',
        'slug' => 'billing',
        'content' => 'Invoices and payments.',
        'visibility' => 'public',
    ], User::first());

    editArticle($this->article)
        ->fillForm([
            'translations' => [
                'de' => [
                    'title' => 'Abrechnung',
                    'slug' => 'billing',
                    'content' => 'Rechnungen und Zahlungen.',
                ],
            ],
        ])
        ->call('save')
        ->assertHasFormErrors(['translations.de.slug']);

    expect($this->article->fresh()->translation('de'))->toBeNull()
        ->and($other->fresh()->slug)->toBe('billing');
});

it('lets an article reuse its own slug in another language', function () {
    editArticle($this->article)
        ->fillForm([
            'translations' => [
                'de' => [
                    'title' => 'Passwort zurücksetzen',
                    'slug' => 'password-reset',
                    'content' => 'So setzt du dein Passwort zurück.',
                ],
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($this->article->fresh()->translation('de')->slug)->toBe('password-reset');
});

it('shows the language states in the list without a query per row', function () {
    foreach (range(1, 5) as $i) {
        $this->service->createArticle([
            'category_id' => $this->category->id,
            'title' => "Extra article {$i}",
            'slug' => "extra-article-{$i}",
            'content' => 'Content.',
            'visibility' => 'public',
        ], User::first());
    }

    DB::enableQueryLog();
    Livewire::test(ListArticles::class)->assertOk();
    $translationQueries = collect(DB::getQueryLog())
        ->filter(fn (array $query): bool => str_contains($query['query'], 'article_translations'))
        ->count();
    DB::disableQueryLog();

    // One eager load for all rows, not one per row and language (6 rows x 2 languages).
    expect($translationQueries)->toBeLessThan(4);
});

it('stores files added in every language tab in the knowledge base attachments directory', function () {
    config(['knowledge-base.attachments' => ['disk' => 'public', 'directory' => 'knowledge-base/attachments']]);

    $usesKnowledgeBaseDirectory = fn (RichEditor $field): bool => $field->getFileAttachmentsDiskName() === 'public'
        && $field->getFileAttachmentsDirectory() === 'knowledge-base/attachments';

    editArticle($this->article)
        ->assertFormFieldExists('translations.en.content', $usesKnowledgeBaseDirectory)
        ->assertFormFieldExists('translations.de.content', $usesKnowledgeBaseDirectory);
});
