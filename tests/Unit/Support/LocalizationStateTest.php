<?php

use JeffersonGoncalves\FilamentKnowledgeBase\Support\LocalizationState;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use JeffersonGoncalves\KnowledgeBase\Enums\TranslationStatus;
use JeffersonGoncalves\KnowledgeBase\Models\ArticleTranslation;

it('reads the state from a translation row', function () {
    $published = new ArticleTranslation(['status' => TranslationStatus::Published->value]);
    $draft = new ArticleTranslation(['status' => TranslationStatus::Draft->value]);
    $outdated = new ArticleTranslation([
        'status' => TranslationStatus::Published->value,
        'is_outdated' => true,
    ]);

    expect(LocalizationState::of($published))->toBe(LocalizationState::PUBLISHED)
        ->and(LocalizationState::of($draft))->toBe(LocalizationState::DRAFT)
        ->and(LocalizationState::of($outdated))->toBe(LocalizationState::OUTDATED)
        ->and(LocalizationState::of(null))->toBe(LocalizationState::MISSING);
});

it('gives every state a label and a color', function () {
    foreach ([
        LocalizationState::MISSING,
        LocalizationState::DRAFT,
        LocalizationState::PUBLISHED,
        LocalizationState::OUTDATED,
    ] as $state) {
        expect(LocalizationState::label($state))->toBeString()->not->toBe('')
            ->and(LocalizationState::color($state))->toBeString();
    }
});

it('detects whether more than one language is configured', function () {
    config(['knowledge-base.locales' => ['en'], 'knowledge-base.default_locale' => 'en']);
    expect(TranslationForm::isMultiLocale())->toBeFalse();

    config(['knowledge-base.locales' => ['en', 'de']]);
    expect(TranslationForm::isMultiLocale())->toBeTrue()
        ->and(TranslationForm::locales())->toBe(['en', 'de']);
});

it('treats a translation with only a status as empty', function () {
    expect(TranslationForm::isEmpty(['status' => 'draft'], TranslationForm::articleFields()))->toBeTrue()
        ->and(TranslationForm::isEmpty(['title' => 'Hello'], TranslationForm::articleFields()))->toBeFalse();
});
