<?php

use Filament\Facades\Filament;
use Illuminate\Support\Carbon;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\Pages\ListArticles;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
use JeffersonGoncalves\KnowledgeBase\Models\Article;
use JeffersonGoncalves\KnowledgeBase\Models\Category;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use Livewire\Livewire;

beforeEach(function () {
    User::createTable();

    Filament::setCurrentPanel(Filament::getPanel('admin'));

    $this->user = User::create(['name' => 'Editor', 'email' => 'editor@example.com']);
    $this->actingAs($this->user);

    $this->service = app(KnowledgeBaseService::class);
    $this->billing = $this->service->createCategory(['name' => 'Billing', 'slug' => 'billing']);
    $this->shipping = $this->service->createCategory(['name' => 'Shipping', 'slug' => 'shipping']);
});

function reorderArticle(Category $category, string $title, string $createdAt): Article
{
    Carbon::setTestNow($createdAt);
    $article = test()->service->createArticle([
        'category_id' => $category->id,
        'title' => $title,
        'content' => 'Content.',
    ], test()->user);
    Carbon::setTestNow();

    return $article;
}

it('lists all articles newest first and offers no reordering without a category filter', function () {
    $old = reorderArticle($this->billing, 'Old', '2026-01-01');
    $new = reorderArticle($this->shipping, 'New', '2026-02-01');

    $component = Livewire::test(ListArticles::class)
        ->assertCanSeeTableRecords([$new, $old], inOrder: true);

    expect($component->instance()->getTable()->isReorderable())->toBeFalse();

    $component->call('reorderTable', [$old->getKey(), $new->getKey()]);

    expect($old->fresh()->sort_order)->toBe(0)
        ->and($new->fresh()->sort_order)->toBe(0);
});

it('reorders the articles of the filtered category', function () {
    $first = reorderArticle($this->billing, 'First', '2026-01-01');
    $second = reorderArticle($this->billing, 'Second', '2026-02-01');
    $third = reorderArticle($this->billing, 'Third', '2026-03-01');
    $other = reorderArticle($this->shipping, 'Other category', '2026-04-01');

    $component = Livewire::test(ListArticles::class)
        ->filterTable('category_id', $this->billing->getKey());

    expect($component->instance()->getTable()->isReorderable())->toBeTrue();

    $component->call('reorderTable', [$second->getKey(), $first->getKey(), $third->getKey()])
        ->assertCanSeeTableRecords([$second, $first, $third], inOrder: true)
        ->assertCanNotSeeTableRecords([$other]);

    expect($second->fresh()->sort_order)->toBe(1)
        ->and($first->fresh()->sort_order)->toBe(2)
        ->and($third->fresh()->sort_order)->toBe(3)
        ->and($other->fresh()->sort_order)->toBe(0);
});

it('lists a category by sort order, then newest first, like the help center', function () {
    $pinned = reorderArticle($this->billing, 'Pinned', '2026-01-01');
    $older = reorderArticle($this->billing, 'Older', '2026-02-01');
    $newer = reorderArticle($this->billing, 'Newer', '2026-03-01');
    $pinned->forceFill(['sort_order' => 0])->save();
    $older->forceFill(['sort_order' => 1])->save();
    $newer->forceFill(['sort_order' => 1])->save();

    Livewire::test(ListArticles::class)
        ->filterTable('category_id', $this->billing->getKey())
        ->assertCanSeeTableRecords([$pinned, $newer, $older], inOrder: true);
});
