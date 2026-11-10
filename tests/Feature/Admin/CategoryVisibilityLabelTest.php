<?php

use Filament\Facades\Filament;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Pages\CreateCategory;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Pages\ListCategories;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ArticleBadge;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
use JeffersonGoncalves\KnowledgeBase\Models\Category;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use Livewire\Livewire;

beforeEach(function () {
    User::createTable();

    Filament::setCurrentPanel(Filament::getPanel('admin'));

    $this->actingAs(User::create(['name' => 'Editor', 'email' => 'editor@example.com']));

    $this->service = app(KnowledgeBaseService::class);
    $this->category = $this->service->createCategory([
        'name' => 'Staff procedures',
        'slug' => 'staff-procedures',
        'visibility' => 'internal',
    ]);
});

it('offers every visibility, signed-in customers included, in the category filter and form', function () {
    $filter = Livewire::test(ListCategories::class)->instance()->getTable()->getFilter('visibility');

    expect(array_keys($filter->getOptions()))->toBe(['public', 'customers', 'internal']);

    Livewire::test(CreateCategory::class)
        ->fillForm(['name' => 'My account', 'slug' => 'my-account', 'visibility' => 'customers'])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Category::query()->where('slug', 'my-account')->value('visibility'))->toBe('customers');
});

it('shows the translated visibility label in the category table instead of the raw value', function () {
    $table = Livewire::test(ListCategories::class)
        ->assertOk()
        ->instance()
        ->getTable();

    $visibility = $table->getColumn('visibility');

    expect($visibility->formatState($this->category->visibility))
        ->toBe(ArticleBadge::visibilityLabel('internal'))
        ->not->toBe('internal');
});
