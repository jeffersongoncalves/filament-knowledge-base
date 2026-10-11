<?php

use Filament\Facades\Filament;
use Filament\Forms\Components\RichEditor;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\CreateArticle;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\EditArticle;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\RichEditor\Actions\AttachFileAction;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\RichEditor\Actions\InsertImageAction;
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

it('leaves the upload tools out on the create page and explains why', function () {
    Livewire::test(CreateArticle::class)
        ->assertOk()
        ->assertSee('Save the article first to add images and files.')
        ->assertFormFieldExists('translations.en.content', fn (RichEditor $field): bool => ! $field->hasToolbarButton(InsertImageAction::NAME)
            && ! $field->hasToolbarButton(AttachFileAction::NAME)
            && ! $field->hasToolbarButton('attachFiles'));
});

it('offers the upload tools on the edit page', function () {
    Livewire::test(EditArticle::class, ['record' => $this->article->getRouteKey()])
        ->assertOk()
        ->assertFormFieldExists('translations.en.content', fn (RichEditor $field): bool => $field->hasToolbarButton(InsertImageAction::NAME)
            && $field->hasToolbarButton(AttachFileAction::NAME));
});
