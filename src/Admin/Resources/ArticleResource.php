<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\Pages;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\RelationManagers;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBasePlugin;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ArticleBadge;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\LocalizationState;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;
use JeffersonGoncalves\KnowledgeBase\Enums\TranslationStatus;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleTranslationContract;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\TranslatableContract;
use JeffersonGoncalves\KnowledgeBase\Support\Locales;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;

class ArticleResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 0;

    public static function getModel(): string
    {
        return ModelResolver::article();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return KnowledgeBasePlugin::get()->getNavigationGroup()
                ?? config('filament-knowledge-base.navigation.admin.group', 'Knowledge Base');
        } catch (\Throwable) {
            return config('filament-knowledge-base.navigation.admin.group', 'Knowledge Base');
        }
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.plural_model_label');
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getEloquentQuery()
            ->where('status', ArticleStatus::Draft->value)
            ->count();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        if (! TranslationForm::isMultiLocale()) {
            return static::singleLocaleForm($form);
        }

        return static::multiLocaleForm($form);
    }

    /**
     * One configured language: the form binds to the article columns exactly
     * as before localization.
     */
    protected static function singleLocaleForm(Form $form): Form
    {
        $schema = [
            Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_content'))
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.title'))
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                            if ($state) {
                                $set('slug', Str::slug($state));
                            }
                        }),
                    Forms\Components\TextInput::make('slug')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.slug'))
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),
                    Forms\Components\Select::make('category_id')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.category'))
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\RichEditor::make('content')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.content'))
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\Textarea::make('excerpt')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.excerpt'))
                        ->rows(3)
                        ->columnSpanFull(),
                ])->columns(2),

            Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_settings'))
                ->schema([
                    Forms\Components\Select::make('status')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.status'))
                        ->options(collect(ArticleStatus::cases())->mapWithKeys(fn (ArticleStatus $status) => [
                            $status->value => $status->label(),
                        ]))
                        ->default(ArticleStatus::Draft->value)
                        ->required(),
                    Forms\Components\Select::make('visibility')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.visibility'))
                        ->options(collect(ArticleVisibility::cases())->mapWithKeys(fn (ArticleVisibility $visibility) => [
                            $visibility->value => $visibility->label(),
                        ]))
                        ->default(ArticleVisibility::Public->value)
                        ->required(),
                    Forms\Components\DateTimePicker::make('published_at')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.published_at')),
                ])->columns(2),
        ];

        if (static::hasSeo()) {
            $schema[] = Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_seo'))
                ->schema(static::seoFields())
                ->columns(2)
                ->collapsible()
                ->collapsed();
        }

        return $form->schema($schema);
    }

    /**
     * More than one language: a tab per language bound to the core's
     * translation rows, an authoritative-language select and the
     * "flag other languages outdated" option.
     */
    protected static function multiLocaleForm(Form $form): Form
    {
        $locales = TranslationForm::locales();
        $default = Locales::default();

        $localeOptions = collect($locales)
            ->mapWithKeys(fn (string $locale): array => [$locale => strtoupper($locale)])
            ->all();

        $tabs = [];

        foreach ($locales as $locale) {
            $tabComponents = [
                Forms\Components\TextInput::make("translations.{$locale}.title")
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.title'))
                    ->required(fn (Forms\Get $get): bool => static::requiresVersion($get, $default, $locale))
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Forms\Set $set, ?string $state) use ($locale) {
                        if ($state) {
                            $set("translations.{$locale}.slug", Str::slug($state));
                        }
                    }),
                Forms\Components\TextInput::make("translations.{$locale}.slug")
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.slug'))
                    ->required(fn (Forms\Get $get): bool => static::requiresVersion($get, $default, $locale))
                    ->maxLength(255)
                    ->rule(TranslationForm::uniqueSlugRule(ModelResolver::articleTranslation(), 'article_id')),
                Forms\Components\RichEditor::make("translations.{$locale}.content")
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.content'))
                    ->required(fn (Forms\Get $get): bool => static::requiresVersion($get, $default, $locale))
                    ->columnSpanFull(),
                Forms\Components\Textarea::make("translations.{$locale}.excerpt")
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.excerpt'))
                    ->rows(3)
                    ->columnSpanFull(),
            ];

            if (static::hasSeo()) {
                $tabComponents = array_merge($tabComponents, static::seoFields($locale));
            }

            $tabComponents[] = Forms\Components\Select::make("translations.{$locale}.status")
                ->label(__('filament-knowledge-base::knowledge-base.admin.localization.version_status'))
                ->options(collect(TranslationStatus::cases())->mapWithKeys(fn (TranslationStatus $status) => [
                    $status->value => $status->label(),
                ]))
                ->default(TranslationStatus::Draft->value)
                ->visible(fn (Forms\Get $get): bool => ! static::isAuthoritative($get, $default, $locale))
                ->helperText(__('filament-knowledge-base::knowledge-base.admin.localization.version_status_helper'));

            $tabs[] = Forms\Components\Tabs\Tab::make(strtoupper($locale))
                ->badge(fn (?Model $record): string => LocalizationState::label(
                    $record instanceof Model ? TranslationForm::state($record, $locale) : LocalizationState::MISSING
                ))
                ->badgeColor(fn (?Model $record): string => LocalizationState::color(
                    $record instanceof Model ? TranslationForm::state($record, $locale) : LocalizationState::MISSING
                ))
                ->schema($tabComponents)
                ->columns(2);
        }

        return $form->schema([
            Forms\Components\Tabs::make('translations')
                ->tabs($tabs)
                ->persistTabInQueryString()
                ->columnSpanFull(),
            Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_settings'))
                ->schema([
                    Forms\Components\Select::make('source_locale')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.localization.source_locale'))
                        ->options($localeOptions)
                        ->default($default)
                        ->required()
                        ->live(),
                    Forms\Components\Toggle::make('flag_other_locales_outdated')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.localization.flag_other_locales_outdated'))
                        ->helperText(__('filament-knowledge-base::knowledge-base.admin.localization.flag_other_locales_outdated_helper'))
                        ->default(false),
                    Forms\Components\Select::make('category_id')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.category'))
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.status'))
                        ->options(collect(ArticleStatus::cases())->mapWithKeys(fn (ArticleStatus $status) => [
                            $status->value => $status->label(),
                        ]))
                        ->default(ArticleStatus::Draft->value)
                        ->required(),
                    Forms\Components\Select::make('visibility')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.visibility'))
                        ->options(collect(ArticleVisibility::cases())->mapWithKeys(fn (ArticleVisibility $visibility) => [
                            $visibility->value => $visibility->label(),
                        ]))
                        ->default(ArticleVisibility::Public->value)
                        ->required(),
                    Forms\Components\DateTimePicker::make('published_at')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.published_at')),
                ])->columns(2),
        ]);
    }

    protected static function isAuthoritative(Forms\Get $get, string $default, string $locale): bool
    {
        return ($get('data.source_locale', isAbsolute: true) ?: $default) === $locale;
    }

    /**
     * A tab's required fields apply to the authoritative language and to any
     * other language with content, so a partly filled tab is a form error
     * instead of a failed insert.
     */
    protected static function requiresVersion(Forms\Get $get, string $default, string $locale): bool
    {
        return static::isAuthoritative($get, $default, $locale)
            || TranslationForm::isFilled($get("data.translations.{$locale}", isAbsolute: true), TranslationForm::articleFields());
    }

    /**
     * @return array<int, Forms\Components\TextInput|Forms\Components\Textarea>
     */
    protected static function seoFields(?string $locale = null): array
    {
        $prefix = $locale !== null ? "translations.{$locale}." : '';

        return [
            Forms\Components\TextInput::make($prefix.'seo_title')
                ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_title'))
                ->maxLength(255),
            Forms\Components\Textarea::make($prefix.'seo_description')
                ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_description'))
                ->rows(2),
            Forms\Components\TextInput::make($prefix.'seo_keywords')
                ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_keywords'))
                ->maxLength(255),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.title'))
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.category'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.status'))
                    ->badge()
                    ->color(fn (ArticleStatus|string|null $state): string => ArticleBadge::statusColor($state))
                    ->formatStateUsing(fn (ArticleStatus|string|null $state): string => ArticleBadge::statusLabel($state)),
                ...static::localizationColumns(),
                Tables\Columns\TextColumn::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.visibility'))
                    ->badge()
                    ->color(fn (ArticleVisibility|string|null $state): string => ArticleBadge::visibilityColor($state))
                    ->formatStateUsing(fn (ArticleVisibility|string|null $state): string => ArticleBadge::visibilityLabel($state))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('view_count')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.view_count'))
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.published_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.status'))
                    ->options(collect(ArticleStatus::cases())->mapWithKeys(fn (ArticleStatus $status) => [
                        $status->value => $status->label(),
                    ])),
                Tables\Filters\SelectFilter::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.visibility'))
                    ->options(collect(ArticleVisibility::cases())->mapWithKeys(fn (ArticleVisibility $visibility) => [
                        $visibility->value => $visibility->label(),
                    ])),
                Tables\Filters\SelectFilter::make('category_id')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.category'))
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                ...static::localizationFilters(),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                ...static::localizationActions(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    /**
     * One state column per configured language (published, draft, outdated or
     * missing), only when more than one language is configured.
     *
     * @return array<int, Tables\Columns\TextColumn>
     */
    protected static function localizationColumns(): array
    {
        if (! TranslationForm::isMultiLocale()) {
            return [];
        }

        return array_map(
            fn (string $locale): Tables\Columns\TextColumn => Tables\Columns\TextColumn::make("localization_state_{$locale}")
                ->label(__('filament-knowledge-base::knowledge-base.admin.localization.language_label', [
                    'language' => strtoupper($locale),
                ]))
                ->badge()
                ->state(fn (Model $record): string => TranslationForm::state($record, $locale))
                ->color(fn (string $state): string => LocalizationState::color($state))
                ->formatStateUsing(fn (string $state): string => LocalizationState::label($state)),
            TranslationForm::locales(),
        );
    }

    /**
     * The "outdated in language X" filter.
     *
     * @return array<int, Tables\Filters\SelectFilter>
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
            Tables\Filters\SelectFilter::make('outdated_locale')
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
     * flagged outdated.
     *
     * @return array<int, Tables\Actions\Action>
     */
    protected static function localizationActions(): array
    {
        if (! TranslationForm::isMultiLocale()) {
            return [];
        }

        return [
            Tables\Actions\Action::make('mark_up_to_date')
                ->label(__('filament-knowledge-base::knowledge-base.admin.localization.mark_up_to_date'))
                ->icon('heroicon-o-check-badge')
                ->visible(fn (Model $record): bool => static::outdatedLocaleOptions($record) !== [])
                ->form([
                    Forms\Components\Select::make('locale')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.localization.language'))
                        ->options(fn (Model $record): array => static::outdatedLocaleOptions($record))
                        ->required(),
                ])
                ->action(function (Model $record, array $data): void {
                    $locale = $data['locale'] ?? null;

                    if (! is_string($locale) || ! $record instanceof TranslatableContract) {
                        return;
                    }

                    $translation = $record->translation($locale);

                    if ($translation instanceof ArticleTranslationContract) {
                        $translation->markUpToDate();
                    }
                }),
        ];
    }

    /**
     * @return array<string, string>
     */
    protected static function outdatedLocaleOptions(Model $record): array
    {
        $translations = $record->getRelationValue('translations');

        if (! $translations instanceof Collection) {
            return [];
        }

        return $translations
            ->filter(fn (Model $translation): bool => (bool) $translation->getAttribute('is_outdated'))
            ->mapWithKeys(fn (Model $translation): array => [
                (string) $translation->getAttribute('locale') => strtoupper((string) $translation->getAttribute('locale')),
            ])
            ->all();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        $schema = [
            Infolists\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_content'))
                ->schema([
                    Infolists\Components\TextEntry::make('title')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.title')),
                    Infolists\Components\TextEntry::make('slug')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.slug')),
                    Infolists\Components\TextEntry::make('category.name')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.category')),
                    Infolists\Components\TextEntry::make('content')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.content'))
                        ->html()
                        ->columnSpanFull(),
                    Infolists\Components\TextEntry::make('excerpt')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.excerpt'))
                        ->columnSpanFull(),
                ])->columns(2),

            Infolists\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_settings'))
                ->schema([
                    Infolists\Components\TextEntry::make('status')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.status'))
                        ->badge()
                        ->color(fn (ArticleStatus|string|null $state): string => ArticleBadge::statusColor($state))
                        ->formatStateUsing(fn (ArticleStatus|string|null $state): string => ArticleBadge::statusLabel($state)),
                    Infolists\Components\TextEntry::make('visibility')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.visibility'))
                        ->badge()
                        ->color(fn (ArticleVisibility|string|null $state): string => ArticleBadge::visibilityColor($state))
                        ->formatStateUsing(fn (ArticleVisibility|string|null $state): string => ArticleBadge::visibilityLabel($state)),
                    Infolists\Components\TextEntry::make('published_at')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.published_at'))
                        ->dateTime(),
                    Infolists\Components\TextEntry::make('view_count')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.view_count')),
                    Infolists\Components\TextEntry::make('helpful_count')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.infolist.helpful_count')),
                    Infolists\Components\TextEntry::make('not_helpful_count')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.infolist.not_helpful_count')),
                    Infolists\Components\TextEntry::make('current_version')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.infolist.current_version')),
                    Infolists\Components\TextEntry::make('created_at')
                        ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                        ->dateTime(),
                    Infolists\Components\TextEntry::make('updated_at')
                        ->label(__('filament-knowledge-base::knowledge-base.common.updated_at'))
                        ->dateTime(),
                ])->columns(3),
        ];

        if (static::hasSeo()) {
            $schema[] = Infolists\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_seo'))
                ->schema([
                    Infolists\Components\TextEntry::make('seo_title')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_title')),
                    Infolists\Components\TextEntry::make('seo_description')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_description')),
                    Infolists\Components\TextEntry::make('seo_keywords')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_keywords')),
                ])->columns(3)
                ->collapsible()
                ->collapsed();
        }

        return $infolist->schema($schema);
    }

    public static function getRelations(): array
    {
        $relations = [];

        try {
            $plugin = KnowledgeBasePlugin::get();

            if ($plugin->hasVersioning()) {
                $relations[] = RelationManagers\VersionsRelationManager::class;
            }

            if ($plugin->hasFeedback()) {
                $relations[] = RelationManagers\FeedbackRelationManager::class;
            }

            if ($plugin->hasRelatedArticles()) {
                $relations[] = RelationManagers\RelatedArticlesRelationManager::class;
            }
        } catch (\Throwable) {
            if (config('filament-knowledge-base.features.versioning', true)) {
                $relations[] = RelationManagers\VersionsRelationManager::class;
            }

            if (config('filament-knowledge-base.features.feedback', true)) {
                $relations[] = RelationManagers\FeedbackRelationManager::class;
            }

            if (config('filament-knowledge-base.features.related_articles', true)) {
                $relations[] = RelationManagers\RelatedArticlesRelationManager::class;
            }
        }

        return $relations;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);

        // The per-language state column and the "mark up to date" action read
        // every version; load them once instead of per row.
        if (TranslationForm::isMultiLocale() && is_a(static::getModel(), TranslatableContract::class, true)) {
            $query->with('translations');
        }

        return $query;
    }

    public static function hasSeo(): bool
    {
        try {
            return KnowledgeBasePlugin::get()->hasSeo();
        } catch (\Throwable) {
            return config('filament-knowledge-base.features.seo', true);
        }
    }
}
