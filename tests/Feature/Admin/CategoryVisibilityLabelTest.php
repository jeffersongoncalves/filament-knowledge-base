<?php

use Filament\Facades\Filament;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Pages\ListCategories;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ArticleBadge;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
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
