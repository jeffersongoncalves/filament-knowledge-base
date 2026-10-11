<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Tables;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ArticleBadge;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\LocalizationState;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;
use JeffersonGoncalves\KnowledgeBase\Models\Article;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleTranslationContract;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.title'))
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                TextColumn::make('category.name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.category'))
                    ->sortable(),
                TextColumn::make('status')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.status'))
                    ->badge()
                    ->color(fn (ArticleStatus|string|null $state): string => ArticleBadge::statusColor($state))
                    ->formatStateUsing(fn (ArticleStatus|string|null $state): string => ArticleBadge::statusLabel($state)),
                ...static::localizationColumns(),
                TextColumn::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.visibility'))
                    ->badge()
                    ->color(fn (ArticleVisibility|string|null $state): string => ArticleBadge::visibilityColor($state))
                    ->formatStateUsing(fn (ArticleVisibility|string|null $state): string => ArticleBadge::visibilityLabel($state))
                    ->toggleable(),
                TextColumn::make('view_count')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.view_count'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('published_at')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.published_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.status'))
                    ->options(collect(ArticleStatus::cases())->mapWithKeys(fn (ArticleStatus $status) => [
                        $status->value => $status->label(),
                    ])),
                SelectFilter::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.visibility'))
                    ->options(collect(ArticleVisibility::cases())->mapWithKeys(fn (ArticleVisibility $visibility) => [
                        $visibility->value => $visibility->label(),
                    ])),
                SelectFilter::make('category_id')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.category'))
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                ...static::localizationFilters(),
                TrashedFilter::make(),
            ])
            ->recordActions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
                ...static::localizationActions(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                    Actions\ForceDeleteBulkAction::make(),
                    Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    /**
     * One state column per configured language (published, draft, outdated or
     * missing), only when more than one language is configured (task 6.2).
     *
     * @return array<int, TextColumn>
     */
    protected static function localizationColumns(): array
    {
        if (! TranslationForm::isMultiLocale()) {
            return [];
        }

        return array_map(
            fn (string $locale): TextColumn => TextColumn::make("localization_state_{$locale}")
                ->label(__('filament-knowledge-base::knowledge-base.admin.localization.language_label', [
                    'language' => strtoupper($locale),
                ]))
                ->badge()
                ->state(fn (Article $record): string => TranslationForm::state($record, $locale))
                ->color(fn (string $state): string => LocalizationState::color($state))
                ->formatStateUsing(fn (string $state): string => LocalizationState::label($state)),
            TranslationForm::locales(),
        );
    }

    /**
     * The "outdated in language X" filter (task 6.2).
     *
     * @return array<int, SelectFilter>
     */
    protected static function localizationFilters(): array
    {
        if (! TranslationForm::isMultiLocale()) {
            return [];
        }

        $options = collect(TranslationForm::locales())
            ->mapWithKeys(fn (string $locale): array => [$locale => strtoupper($locale)])
            ->all();

        return [
            SelectFilter::make('outdated_locale')
                ->label(__('filament-knowledge-base::knowledge-base.admin.localization.outdated_filter'))
                ->options($options)
                ->query(function (Builder $query, array $data): Builder {
                    $locale = $data['value'] ?? null;

                    if (! is_string($locale) || $locale === '') {
                        return $query;
                    }

                    return $query->whereHas('translations', fn (Builder $translations): Builder => $translations
                        ->where('locale', $locale)
                        ->where('is_outdated', true));
                }),
        ];
    }

    /**
     * The "mark up to date" action, choosing among the languages currently
     * flagged outdated (task 6.2).
     *
     * @return array<int, Actions\Action>
     */
    protected static function localizationActions(): array
    {
        if (! TranslationForm::isMultiLocale()) {
            return [];
        }

        return [
            Actions\Action::make('mark_up_to_date')
                ->label(__('filament-knowledge-base::knowledge-base.admin.localization.mark_up_to_date'))
                ->icon('heroicon-o-check-badge')
                ->visible(fn (Article $record): bool => static::hasOutdatedTranslation($record))
                ->form([
                    Select::make('locale')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.localization.language'))
                        ->options(fn (Article $record): array => static::outdatedLocaleOptions($record))
                        ->required(),
                ])
                ->action(function (Article $record, array $data): void {
                    $locale = $data['locale'] ?? null;

                    if (! is_string($locale)) {
                        return;
                    }

                    $translation = $record->translation($locale);

                    if ($translation instanceof ArticleTranslationContract) {
                        $translation->markUpToDate();
                    }
                }),
        ];
    }

    protected static function hasOutdatedTranslation(Article $record): bool
    {
        return $record->translations
            ->contains(fn (Model $translation): bool => (bool) $translation->getAttribute('is_outdated'));
    }

    /**
     * @return array<string, string>
     */
    protected static function outdatedLocaleOptions(Article $record): array
    {
        return $record->translations
            ->filter(fn (Model $translation): bool => (bool) $translation->getAttribute('is_outdated'))
            ->mapWithKeys(fn (Model $translation): array => [
                (string) $translation->getAttribute('locale') => strtoupper((string) $translation->getAttribute('locale')),
            ])
            ->all();
    }
}
