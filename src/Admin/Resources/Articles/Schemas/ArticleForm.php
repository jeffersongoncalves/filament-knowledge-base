<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\ArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ContentAttachments;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\LocalizationState;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;
use JeffersonGoncalves\KnowledgeBase\Enums\TranslationStatus;
use JeffersonGoncalves\KnowledgeBase\Support\Locales;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        if (! TranslationForm::isMultiLocale()) {
            return static::configureSingleLocale($schema);
        }

        return static::configureMultiLocale($schema);
    }

    /**
     * One configured language: the form binds to the article columns exactly
     * as before localization (task 6.3).
     */
    protected static function configureSingleLocale(Schema $schema): Schema
    {
        $components = [
            Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_content'))
                ->schema([
                    TextInput::make('title')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.title'))
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, ?string $state) {
                            if ($state) {
                                $set('slug', Str::slug($state));
                            }
                        }),
                    TextInput::make('slug')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.slug'))
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),
                    Select::make('category_id')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.category'))
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    ContentAttachments::configure(RichEditor::make('content'))
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.content'))
                        ->required()
                        ->columnSpanFull(),
                    Textarea::make('excerpt')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.excerpt'))
                        ->rows(3)
                        ->columnSpanFull(),
                ])->columns(2),

            Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_settings'))
                ->schema([
                    Select::make('status')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.status'))
                        ->options(collect(ArticleStatus::cases())->mapWithKeys(fn (ArticleStatus $status) => [
                            $status->value => $status->label(),
                        ]))
                        ->default(ArticleStatus::Draft->value)
                        ->required(),
                    Select::make('visibility')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.visibility'))
                        ->options(collect(ArticleVisibility::cases())->mapWithKeys(fn (ArticleVisibility $visibility) => [
                            $visibility->value => $visibility->label(),
                        ]))
                        ->default(ArticleVisibility::Public->value)
                        ->required(),
                    DateTimePicker::make('published_at')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.published_at')),
                ])->columns(2),
        ];

        if (ArticleResource::hasSeo()) {
            $components[] = Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_seo'))
                ->schema(static::seoFields())
                ->columns(2)
                ->collapsible()
                ->collapsed();
        }

        return $schema
            ->columns(null)
            ->components($components);
    }

    /**
     * More than one language: a tab per language bound to the core's
     * translation rows and the "flag other languages outdated" option (design
     * D9). The authoritative language is always the configured default, so the
     * form offers no choice of it.
     */
    protected static function configureMultiLocale(Schema $schema): Schema
    {
        $locales = TranslationForm::locales();
        $default = Locales::default();

        $tabs = [];

        foreach ($locales as $locale) {
            $tabComponents = [
                TextInput::make("translations.{$locale}.title")
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.title'))
                    ->required(fn (Get $get): bool => static::requiresVersion($get, $default, $locale))
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, ?string $state) use ($locale) {
                        if ($state) {
                            $set("translations.{$locale}.slug", Str::slug($state));
                        }
                    }),
                TextInput::make("translations.{$locale}.slug")
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.slug'))
                    ->required(fn (Get $get): bool => static::requiresVersion($get, $default, $locale))
                    ->maxLength(255)
                    ->rule(TranslationForm::uniqueSlugRule(ModelResolver::articleTranslation(), 'article_id')),
                ContentAttachments::configure(RichEditor::make("translations.{$locale}.content"))
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.content'))
                    ->required(fn (Get $get): bool => static::requiresVersion($get, $default, $locale))
                    ->columnSpanFull(),
                Textarea::make("translations.{$locale}.excerpt")
                    ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.excerpt'))
                    ->rows(3)
                    ->columnSpanFull(),
            ];

            if (ArticleResource::hasSeo()) {
                $tabComponents = array_merge($tabComponents, static::seoFields($locale));
            }

            $tabComponents[] = Select::make("translations.{$locale}.status")
                ->label(__('filament-knowledge-base::knowledge-base.admin.localization.version_status'))
                ->options(collect(TranslationStatus::cases())->mapWithKeys(fn (TranslationStatus $status) => [
                    $status->value => $status->label(),
                ]))
                ->default(TranslationStatus::Draft->value)
                ->visible($locale !== $default)
                ->helperText(__('filament-knowledge-base::knowledge-base.admin.localization.version_status_helper'));

            $tabs[] = Tab::make(strtoupper($locale))
                ->badge(fn (?Model $record): string => LocalizationState::label(
                    $record instanceof Model
                        ? TranslationForm::state($record, $locale)
                        : LocalizationState::MISSING
                ))
                ->badgeColor(fn (?Model $record): string => LocalizationState::color(
                    $record instanceof Model
                        ? TranslationForm::state($record, $locale)
                        : LocalizationState::MISSING
                ))
                ->schema($tabComponents);
        }

        $components = [
            Tabs::make('translations')->tabs($tabs)->persistTabInQueryString(),
            Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_settings'))
                ->schema([
                    Toggle::make('flag_other_locales_outdated')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.localization.flag_other_locales_outdated'))
                        ->helperText(__('filament-knowledge-base::knowledge-base.admin.localization.flag_other_locales_outdated_helper'))
                        ->default(false),
                    Select::make('category_id')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.category'))
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    Select::make('status')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.status'))
                        ->options(collect(ArticleStatus::cases())->mapWithKeys(fn (ArticleStatus $status) => [
                            $status->value => $status->label(),
                        ]))
                        ->default(ArticleStatus::Draft->value)
                        ->required(),
                    Select::make('visibility')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.visibility'))
                        ->options(collect(ArticleVisibility::cases())->mapWithKeys(fn (ArticleVisibility $visibility) => [
                            $visibility->value => $visibility->label(),
                        ]))
                        ->default(ArticleVisibility::Public->value)
                        ->required(),
                    DateTimePicker::make('published_at')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.published_at')),
                ])->columns(2),
        ];

        return $schema
            ->columns(null)
            ->components($components);
    }

    /**
     * A tab's required fields apply to the default (authoritative) language
     * and to any other language with content, so a partly filled tab is a form
     * error instead of a failed insert.
     */
    protected static function requiresVersion(Get $get, string $default, string $locale): bool
    {
        return $locale === $default
            || TranslationForm::isFilled($get("data.translations.{$locale}", isAbsolute: true), TranslationForm::articleFields());
    }

    /**
     * @return array<int, TextInput|Textarea>
     */
    protected static function seoFields(?string $locale = null): array
    {
        $prefix = $locale !== null ? "translations.{$locale}." : '';

        return [
            TextInput::make($prefix.'seo_title')
                ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_title'))
                ->maxLength(255),
            Textarea::make($prefix.'seo_description')
                ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_description'))
                ->rows(2),
            TextInput::make($prefix.'seo_keywords')
                ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_keywords'))
                ->maxLength(255),
        ];
    }
}
