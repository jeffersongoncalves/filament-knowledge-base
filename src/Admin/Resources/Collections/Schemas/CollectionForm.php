<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Collections\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
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
use Illuminate\Support\Str;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\CustomerVisibility;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use JeffersonGoncalves\KnowledgeBase\Support\Locales;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;

class CollectionForm
{
    public static function configure(Schema $schema): Schema
    {
        if (! TranslationForm::isMultiLocale()) {
            return static::configureSingleLocale($schema);
        }

        return static::configureMultiLocale($schema);
    }

    /**
     * One configured language: the form binds to the collection columns exactly
     * as a single-language admin would expect, with no language tabs (task 4.1).
     */
    protected static function configureSingleLocale(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make(__('filament-knowledge-base::knowledge-base.admin.collections.form.section_details'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.name'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        TextInput::make('slug')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.slug'))
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Textarea::make('description')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.description'))
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
                Section::make(__('filament-knowledge-base::knowledge-base.admin.collections.form.section_settings'))
                    ->schema(static::settingsFields())
                    ->columns(2),
                static::articlesSection(),
            ]);
    }

    /**
     * More than one language: a tab per language bound to the core's collection
     * translation rows. Collections always have a version in the default
     * language, so only that tab is required.
     */
    protected static function configureMultiLocale(Schema $schema): Schema
    {
        $default = Locales::default();
        $tabs = [];

        foreach (TranslationForm::locales() as $locale) {
            $required = $locale === $default;

            $tabs[] = Tab::make(strtoupper($locale))
                ->schema([
                    TextInput::make("translations.{$locale}.name")
                        ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.name'))
                        ->required($required)
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, ?string $state) use ($locale) {
                            if ($state) {
                                $set("translations.{$locale}.slug", Str::slug($state));
                            }
                        }),
                    TextInput::make("translations.{$locale}.slug")
                        ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.slug'))
                        ->required($required)
                        ->maxLength(255)
                        ->rule(TranslationForm::uniqueSlugRule(ModelResolver::collectionTranslation(), 'collection_id')),
                    Textarea::make("translations.{$locale}.description")
                        ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.description'))
                        ->rows(3)
                        ->columnSpanFull(),
                ])->columns(2);
        }

        return $schema
            ->columns(null)
            ->components([
                Tabs::make('translations')->tabs($tabs)->persistTabInQueryString(),
                Section::make(__('filament-knowledge-base::knowledge-base.admin.collections.form.section_settings'))
                    ->schema(static::settingsFields())
                    ->columns(2),
                static::articlesSection(),
            ]);
    }

    /**
     * @return array<int, TextInput|Toggle>
     */
    protected static function settingsFields(): array
    {
        return [
            Toggle::make('is_active')
                ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.is_active'))
                ->default(true),
            TextInput::make('sort_order')
                ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.sort_order'))
                ->numeric()
                ->default(0),
        ];
    }

    /**
     * The ordered article picker (task 4.2): a drag-and-drop list of articles,
     * each selecting one article and warning when customers cannot see it.
     */
    protected static function articlesSection(): Section
    {
        return Section::make(__('filament-knowledge-base::knowledge-base.admin.collections.form.articles_section'))
            ->description(__('filament-knowledge-base::knowledge-base.admin.collections.form.articles_helper'))
            ->schema([
                Repeater::make('articles')
                    ->hiddenLabel()
                    ->schema([
                        Select::make('id')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.article'))
                            ->options(fn (): array => static::articleOptions())
                            ->searchable()
                            ->required()
                            ->live(),
                        Placeholder::make('visibility_warning')
                            ->hiddenLabel()
                            ->content(fn (Get $get): string => CustomerVisibility::warningFor($get('id')) ?? '')
                            ->visible(fn (Get $get): bool => CustomerVisibility::warningFor($get('id')) !== null),
                    ])
                    ->columns(2)
                    ->reorderable()
                    ->addActionLabel(__('filament-knowledge-base::knowledge-base.admin.collections.form.add_article'))
                    ->defaultItems(0),
            ]);
    }

    /**
     * @return array<int, string>
     */
    protected static function articleOptions(): array
    {
        $articleClass = ModelResolver::article();

        /** @var array<int, string> $options */
        $options = $articleClass::query()
            ->orderBy('title')
            ->pluck('title', 'id')
            ->all();

        return $options;
    }
}
