<?php

use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Pages\KnowledgeBasePage as GuestKnowledgeBasePage;
use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Resources\Articles\ArticleResource as GuestArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Guest\Widgets\PopularArticlesWidget as GuestPopularArticlesWidget;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\PublicVisibility;
use JeffersonGoncalves\FilamentKnowledgeBase\Tests\Fixtures\User;
use JeffersonGoncalves\FilamentKnowledgeBase\User\Pages\KnowledgeBasePage as UserKnowledgeBasePage;
use JeffersonGoncalves\FilamentKnowledgeBase\User\Resources\Articles\ArticleResource as UserArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\User\Widgets\PopularArticlesWidget as UserPopularArticlesWidget;
use JeffersonGoncalves\KnowledgeBase\Models\Article;
use JeffersonGoncalves\KnowledgeBase\Models\Category;
use JeffersonGoncalves\KnowledgeBase\Services\KnowledgeBaseService;
use Livewire\Livewire;

/**
 * The Guest and User panels must show customers only what the core's public
 * visibility rules allow (spec: public-panels-visibility). These tests need a
 * core release with the public scopes (#15); with an older core they skip
 * themselves and the panels keep their previous behaviour.
 */
beforeEach(function () {

    User::createTable();
    $this->service = app(KnowledgeBaseService::class);
    $this->user = User::create(['name' => 'Editor', 'email' => 'editor@example.com']);

    $this->public = $this->service->createCategory([
        'name' => 'Billing',
        'slug' => 'billing',
        'visibility' => 'public',
    ]);

    $this->internal = $this->service->createCategory([
        'name' => 'Internal procedures',
        'slug' => 'internal-procedures',
        'visibility' => 'internal',
    ]);
});

function publishedPanelArticle(array $overrides = []): Article
{
    $article = test()->service->createArticle(array_merge([
        'category_id' => test()->public->id,
        'title' => 'Account application',
        'content' => 'How long an Account application takes.',
        'visibility' => 'public',
    ], $overrides), test()->user);

    return test()->service->publishArticle($article);
}

function guestPanelIds(): array
{
    return GuestArticleResource::getEloquentQuery()->pluck('id')->all();
}

function userPanelIds(): array
{
    return UserArticleResource::getEloquentQuery()->pluck('id')->all();
}

it('keeps a public article in a public category in both panels', function () {
    $visible = publishedPanelArticle(['slug' => 'account-application']);

    expect(guestPanelIds())->toContain($visible->id)
        ->and(userPanelIds())->toContain($visible->id)
        ->and(GuestArticleResource::getEloquentQuery()->whereKey($visible->id)->exists())->toBeTrue()
        ->and(UserArticleResource::getEloquentQuery()->whereKey($visible->id)->exists())->toBeTrue();
});

it('hides a public article in an internal category from both panels', function () {
    $leak = publishedPanelArticle([
        'category_id' => $this->internal->id,
        'slug' => 'account-file-check-checklist',
    ]);

    expect(guestPanelIds())->not->toContain($leak->id)
        ->and(userPanelIds())->not->toContain($leak->id)
        ->and(GuestArticleResource::getEloquentQuery()->whereKey($leak->id)->exists())->toBeFalse()
        ->and(UserArticleResource::getEloquentQuery()->whereKey($leak->id)->exists())->toBeFalse();
});

it('hides an internal article from both panels', function () {
    $internalArticle = publishedPanelArticle([
        'slug' => 'account-escalation',
        'visibility' => 'internal',
    ]);

    expect(guestPanelIds())->not->toContain($internalArticle->id)
        ->and(userPanelIds())->not->toContain($internalArticle->id);
});

it('hides a public category under an internal parent', function () {
    $child = $this->service->createCategory([
        'name' => 'Customer questions',
        'slug' => 'customer-questions',
        'parent_id' => $this->internal->id,
        'visibility' => 'public',
    ]);

    $visibleCategoryIds = PublicVisibility::scopeCategories(Category::query())->pluck('id')->all();

    expect($visibleCategoryIds)->toContain($this->public->id)
        ->not->toContain($this->internal->id)
        ->not->toContain($child->id);
});

it('hides an inactive public category from the category menu', function () {
    $inactive = $this->service->createCategory([
        'name' => 'Archive',
        'slug' => 'archive',
        'visibility' => 'public',
        'is_active' => false,
    ]);

    expect(PublicVisibility::rootCategories()->pluck('id')->all())
        ->toContain($this->public->id)
        ->not->toContain($this->internal->id)
        ->not->toContain($inactive->id);
});

it('counts only publicly visible articles on the category menu', function () {
    publishedPanelArticle(['slug' => 'public-article']);

    $internalArticle = $this->service->createArticle([
        'category_id' => $this->public->id,
        'title' => 'Internal note',
        'slug' => 'internal-note',
        'content' => 'Staff only.',
        'visibility' => 'internal',
    ], $this->user);
    $this->service->publishArticle($internalArticle);

    $category = PublicVisibility::rootCategories()->firstWhere('id', $this->public->id);

    expect($category->articles_count)->toBe(1);
});

it('shows a customers article to signed-in customers in the User panel only', function () {
    $forCustomers = publishedPanelArticle(['slug' => 'account-limits', 'visibility' => 'customers']);

    expect(userPanelIds())->toContain($forCustomers->id)
        ->and(guestPanelIds())->not->toContain($forCustomers->id);
});

it('shows a customers category and its articles in the User panel only', function () {
    $accounts = $this->service->createCategory(['name' => 'My account', 'slug' => 'my-account', 'visibility' => 'customers']);
    $inside = publishedPanelArticle(['category_id' => $accounts->id, 'slug' => 'change-password']);

    $userMenu = (new UserKnowledgeBasePage)->getCategories();
    $guestMenu = (new GuestKnowledgeBasePage)->getCategories();

    expect(userPanelIds())->toContain($inside->id)
        ->and(guestPanelIds())->not->toContain($inside->id)
        ->and($userMenu->pluck('id')->all())->toContain($accounts->id)
        ->and($userMenu->firstWhere('id', $accounts->id)->articles_count)->toBe(1)
        ->and($guestMenu->pluck('id')->all())->not->toContain($accounts->id);
});

it('finds customers articles in the User panel search only', function () {
    $public = publishedPanelArticle(['slug' => 'account-public', 'title' => 'Account opening']);
    $forCustomers = publishedPanelArticle(['slug' => 'account-customers', 'title' => 'Account limits', 'visibility' => 'customers']);
    $internalArticle = publishedPanelArticle(['slug' => 'account-internal', 'title' => 'Account escalation', 'visibility' => 'internal']);

    $user = new UserKnowledgeBasePage;
    $user->search = 'Account';
    $guest = new GuestKnowledgeBasePage;
    $guest->search = 'Account';

    expect($user->getSearchResults()->pluck('id')->all())
        ->toContain($public->id, $forCustomers->id)
        ->not->toContain($internalArticle->id)
        ->and($guest->getSearchResults()->pluck('id')->all())
        ->toContain($public->id)
        ->not->toContain($forCustomers->id, $internalArticle->id);
});

it('lists customers articles among the popular ones in the User panel only', function () {
    $forCustomers = publishedPanelArticle(['slug' => 'popular-customers', 'visibility' => 'customers']);

    Livewire::test(UserPopularArticlesWidget::class)->assertCanSeeTableRecords([$forCustomers]);
    Livewire::test(GuestPopularArticlesWidget::class)->assertCanNotSeeTableRecords([$forCustomers]);
});

it('does not show an article customers cannot see as popular', function () {
    $visible = publishedPanelArticle(['slug' => 'popular-public']);
    $leak = publishedPanelArticle([
        'category_id' => $this->internal->id,
        'slug' => 'popular-hidden',
    ]);

    $popularIds = PublicVisibility::popularArticlesQuery()->pluck('id')->all();

    expect($popularIds)->toContain($visible->id)
        ->not->toContain($leak->id);
});
