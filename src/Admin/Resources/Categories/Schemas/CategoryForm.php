<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Schemas;

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
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use JeffersonGoncalves\KnowledgeBase\Support\Locales;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        if (! TranslationForm::isMultiLocale()) {
            return static::configureSingleLocale($schema);
        }

        return static::configureMultiLocale($schema);
    }

    /**
     * One configured language: the form binds to the category columns exactly
     * as before localization (task 6.3).
     */
    protected static function configureSingleLocale(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
                Section::make(__('filament-knowledge-base::knowledge-base.admin.categories.form.section_details'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.name'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Set $set, ?string $state) {
                                if ($state) {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        TextInput::make('slug')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.slug'))
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Select::make('parent_id')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.parent'))
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Textarea::make('description')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.description'))
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
                Section::make(__('filament-knowledge-base::knowledge-base.admin.categories.form.section_settings'))
                    ->schema(static::settingsFields())
                    ->columns(2),
            ]);
    }

    /**
     * More than one language: a tab per language bound to the core's category
     * translation rows (design D9). Categories always have a version in the
     * default language, so only that tab is required.
     */
    protected static function configureMultiLocale(Schema $schema): Schema
    {
        $default = Locales::default();
        $tabs = [];

        foreach (TranslationForm::locales() as $locale) {
            // The default language is always required; any other language
            // with content needs a name and slug too (a form error instead of
            // a failed insert).
            $required = fn (Get $get): bool => $locale === $default
                || TranslationForm::isFilled($get("data.translations.{$locale}", isAbsolute: true), TranslationForm::categoryFields());

            $tabs[] = Tab::make(strtoupper($locale))
                ->schema([
                    TextInput::make("translations.{$locale}.name")
                        ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.name'))
                        ->required($required)
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, ?string $state) use ($locale) {
                            if ($state) {
                                $set("translations.{$locale}.slug", Str::slug($state));
                            }
                        }),
                    TextInput::make("translations.{$locale}.slug")
                        ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.slug'))
                        ->required($required)
                        ->maxLength(255)
                        ->rule(TranslationForm::uniqueSlugRule(ModelResolver::categoryTranslation(), 'category_id')),
                    Textarea::make("translations.{$locale}.description")
                        ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.description'))
                        ->rows(3)
                        ->columnSpanFull(),
                ])->columns(2);
        }

        return $schema
            ->columns(null)
            ->components([
                Tabs::make('translations')
                    ->tabs($tabs)
                    ->persistTabInQueryString()
                    ->extraAttributes(['class' => 'kb-language-tabs']),
                Section::make(__('filament-knowledge-base::knowledge-base.admin.categories.form.section_settings'))
                    ->schema([
                        Select::make('parent_id')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.parent'))
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        ...static::settingsFields(),
                    ])->columns(2),
            ]);
    }

    /**
     * @return array<int, Select|TextInput|Toggle>
     */
    protected static function settingsFields(): array
    {
        return [
            TextInput::make('icon')
                ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.icon'))
                ->placeholder('heroicon-o-folder')
                ->maxLength(255),
            Select::make('visibility')
                ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.visibility'))
                ->options([
                    'public' => __('filament-knowledge-base::knowledge-base.common.visibility.public'),
                    'internal' => __('filament-knowledge-base::knowledge-base.common.visibility.internal'),
                ])
                ->default('public')
                ->required(),
            Toggle::make('is_active')
                ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.is_active'))
                ->default(true),
            TextInput::make('sort_order')
                ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.sort_order'))
                ->numeric()
                ->default(0),
        ];
    }
}
