<?php

use Filament\Facades\Filament;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Pages\CreateCategory;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Pages\EditCategory;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
use JeffersonGoncalves\KnowledgeBase\Models\Category;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use Livewire\Livewire;

beforeEach(function () {
    config([
        'knowledge-base.locales' => ['en', 'de'],
        'knowledge-base.default_locale' => 'en',
        'knowledge-base.missing_translation' => 'fallback',
    ]);

    User::createTable();

    Filament::setCurrentPanel(Filament::getPanel('admin'));

    $this->actingAs(User::create(['name' => 'Editor', 'email' => 'editor@example.com']));

    $this->service = app(KnowledgeBaseService::class);
    $this->category = $this->service->createCategory([
        'name' => 'Billing',
        'slug' => 'billing',
        'description' => 'Invoices and payments.',
        'visibility' => 'public',
    ]);
});

it('translates a category when the German tab is filled in', function () {
    Livewire::test(EditCategory::class, ['record' => $this->category->getRouteKey()])
        ->assertOk()
        ->fillForm([
            'translations' => [
                'de' => [
                    'name' => 'Abrechnung',
                    'slug' => 'abrechnung',
                    'description' => 'Alles an einem Ort.',
                ],
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $german = $this->category->fresh()->translation('de');

    expect($german)->not->toBeNull()
        ->and($german->name)->toBe('Abrechnung')
        ->and($this->category->fresh()->name)->toBe('Billing');
});

it('creates a category with an English and a German version', function () {
    Livewire::test(CreateCategory::class)
        ->fillForm([
            'visibility' => 'public',
            'translations' => [
                'en' => [
                    'name' => 'Subscriptions',
                    'slug' => 'subscriptions',
                    'description' => 'Plans and renewals.',
                ],
                'de' => [
                    'name' => 'Abonnements',
                    'slug' => 'abonnements',
                    'description' => 'Tarife und Verlängerungen.',
                ],
            ],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $category = Category::where('slug', 'subscriptions')->firstOrFail();

    expect($category->translation('en'))->not->toBeNull()
        ->and($category->translation('de'))->not->toBeNull()
        ->and($category->translation('de')->name)->toBe('Abonnements');
});

it('keeps the category form bound to the category columns with one language', function () {
    config(['knowledge-base.locales' => ['en'], 'knowledge-base.default_locale' => 'en']);

    Livewire::test(EditCategory::class, ['record' => $this->category->getRouteKey()])
        ->fillForm(['name' => 'Billing (edited)'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($this->category->fresh()->name)->toBe('Billing (edited)');
});
