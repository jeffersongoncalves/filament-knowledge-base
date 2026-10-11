<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CollectionResource\Pages;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBasePlugin;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\CustomerVisibility;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use JeffersonGoncalves\KnowledgeBase\Support\Locales;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;

class CollectionResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 2;

    public static function getModel(): string
    {
        return ModelResolver::collection();
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
        return __('filament-knowledge-base::knowledge-base.admin.collections.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.collections.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.collections.plural_model_label');
    }

    public static function form(Form $form): Form
    {
        if (! TranslationForm::isMultiLocale()) {
            return static::singleLocaleForm($form);
        }

        return static::multiLocaleForm($form);
    }

    /**
     * One configured language: the form binds to the collection columns, with
     * no language tabs.
     */
    protected static function singleLocaleForm(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.collections.form.section_details'))
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.name'))
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                            if ($state) {
                                $set('slug', Str::slug($state));
                            }
                        }),
                    Forms\Components\TextInput::make('slug')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.slug'))
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),
                    Forms\Components\Textarea::make('description')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.description'))
                        ->rows(3)
                        ->columnSpanFull(),
                ])->columns(2),
            Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.collections.form.section_settings'))
                ->schema(static::settingsFields())
                ->columns(2),
            static::articlesSection(),
        ]);
    }

    /**
     * More than one language: a tab per language bound to the core's collection
     * translation rows. Collections always have a version in the default
     * language; any other language with content needs a name and slug too.
     */
    protected static function multiLocaleForm(Form $form): Form
    {
        $default = Locales::default();
        $tabs = [];

        foreach (TranslationForm::locales() as $locale) {
            $required = fn (Forms\Get $get): bool => $locale === $default
                || TranslationForm::isFilled($get("data.translations.{$locale}", isAbsolute: true), TranslationForm::collectionFields());

            $tabs[] = Forms\Components\Tabs\Tab::make(strtoupper($locale))
                ->schema([
                    Forms\Components\TextInput::make("translations.{$locale}.name")
                        ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.name'))
                        ->required($required)
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Forms\Set $set, ?string $state) use ($locale) {
                            if ($state) {
                                $set("translations.{$locale}.slug", Str::slug($state));
                            }
                        }),
                    Forms\Components\TextInput::make("translations.{$locale}.slug")
                        ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.slug'))
                        ->required($required)
                        ->maxLength(255)
                        ->rule(TranslationForm::uniqueSlugRule(ModelResolver::collectionTranslation(), 'collection_id')),
                    Forms\Components\Textarea::make("translations.{$locale}.description")
                        ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.description'))
                        ->rows(3)
                        ->columnSpanFull(),
                ])->columns(2);
        }

        return $form->schema([
            Forms\Components\Tabs::make('translations')
                ->tabs($tabs)
                ->persistTabInQueryString()
                ->columnSpanFull(),
            Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.collections.form.section_settings'))
                ->schema(static::settingsFields())
                ->columns(2),
            static::articlesSection(),
        ]);
    }

    /**
     * @return array<int, Forms\Components\TextInput|Forms\Components\Toggle>
     */
    protected static function settingsFields(): array
    {
        return [
            Forms\Components\Toggle::make('is_active')
                ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.is_active'))
                ->default(true),
            Forms\Components\TextInput::make('sort_order')
                ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.sort_order'))
                ->numeric()
                ->default(0),
        ];
    }

    /**
     * The ordered article picker: a drag-and-drop list of articles, each
     * selecting one article and warning when customers cannot see it.
     */
    protected static function articlesSection(): Forms\Components\Section
    {
        return Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.collections.form.articles_section'))
            ->description(__('filament-knowledge-base::knowledge-base.admin.collections.form.articles_helper'))
            ->schema([
                Forms\Components\Repeater::make('articles')
                    ->hiddenLabel()
                    ->schema([
                        Forms\Components\Select::make('id')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.collections.form.article'))
                            ->options(fn (): array => static::articleOptions())
                            ->searchable()
                            ->required()
                            ->distinct()
                            ->live(),
                        Forms\Components\Placeholder::make('visibility_warning')
                            ->hiddenLabel()
                            ->content(fn (Forms\Get $get): string => CustomerVisibility::warningFor($get('id')) ?? '')
                            ->visible(fn (Forms\Get $get): bool => CustomerVisibility::warningFor($get('id')) !== null),
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.collections.table.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.collections.table.slug'))
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('articles_count')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.collections.table.articles_count'))
                    ->counts('articles')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.collections.table.is_active'))
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.collections.table.sort_order'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.collections.table.is_active')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCollections::route('/'),
            'create' => Pages\CreateCollection::route('/create'),
            'edit' => Pages\EditCollection::route('/{record}/edit'),
        ];
    }
}
