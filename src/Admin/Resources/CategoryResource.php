<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\CategoryResource\Pages;
use JeffersonGoncalves\FilamentKnowledgeBase\KnowledgeBasePlugin;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use JeffersonGoncalves\KnowledgeBase\Support\Locales;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;

class CategoryResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?int $navigationSort = 1;

    public static function getModel(): string
    {
        return ModelResolver::category();
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
        return __('filament-knowledge-base::knowledge-base.admin.categories.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.categories.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.categories.plural_model_label');
    }

    public static function form(Form $form): Form
    {
        if (! TranslationForm::isMultiLocale()) {
            return static::singleLocaleForm($form);
        }

        return static::multiLocaleForm($form);
    }

    /**
     * More than one language: a tab per language bound to the core's category
     * translation rows. Categories always have a version in the default
     * language, so only that tab is required.
     */
    protected static function multiLocaleForm(Form $form): Form
    {
        $default = Locales::default();
        $tabs = [];

        foreach (TranslationForm::locales() as $locale) {
            $required = $locale === $default;

            $tabs[] = Forms\Components\Tabs\Tab::make(strtoupper($locale))
                ->schema([
                    Forms\Components\TextInput::make("translations.{$locale}.name")
                        ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.name'))
                        ->required($required)
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Forms\Set $set, ?string $state) use ($locale) {
                            if ($state) {
                                $set("translations.{$locale}.slug", Str::slug($state));
                            }
                        }),
                    Forms\Components\TextInput::make("translations.{$locale}.slug")
                        ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.slug'))
                        ->required($required)
                        ->maxLength(255)
                        ->rule(TranslationForm::uniqueSlugRule(ModelResolver::categoryTranslation(), 'category_id')),
                    Forms\Components\Textarea::make("translations.{$locale}.description")
                        ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.description'))
                        ->rows(3)
                        ->columnSpanFull(),
                ])->columns(2);
        }

        return $form
            ->schema([
                Forms\Components\Tabs::make('translations')
                    ->tabs($tabs)
                    ->persistTabInQueryString()
                    ->columnSpanFull(),
                Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.categories.form.section_settings'))
                    ->schema([
                        Forms\Components\Select::make('parent_id')
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
     * One configured language: the form binds to the category columns exactly
     * as before localization.
     */
    protected static function singleLocaleForm(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.categories.form.section_details'))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.name'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                                if ($state) {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        Forms\Components\TextInput::make('slug')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.slug'))
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('parent_id')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.parent'))
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Forms\Components\Textarea::make('description')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.description'))
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(2),
                Forms\Components\Section::make(__('filament-knowledge-base::knowledge-base.admin.categories.form.section_settings'))
                    ->schema(static::settingsFields())
                    ->columns(2),
            ]);
    }

    /**
     * @return array<int, Forms\Components\Select|Forms\Components\TextInput|Forms\Components\Toggle>
     */
    protected static function settingsFields(): array
    {
        return [
            Forms\Components\TextInput::make('icon')
                ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.icon'))
                ->placeholder('heroicon-o-folder')
                ->maxLength(255),
            Forms\Components\Select::make('visibility')
                ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.visibility'))
                ->options([
                    'public' => __('filament-knowledge-base::knowledge-base.common.visibility.public'),
                    'internal' => __('filament-knowledge-base::knowledge-base.common.visibility.internal'),
                ])
                ->default('public')
                ->required(),
            Forms\Components\Toggle::make('is_active')
                ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.is_active'))
                ->default(true),
            Forms\Components\TextInput::make('sort_order')
                ->label(__('filament-knowledge-base::knowledge-base.admin.categories.form.sort_order'))
                ->numeric()
                ->default(0),
        ];
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.name'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('parent.name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.parent'))
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('articles_count')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.articles_count'))
                    ->counts('articles')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.is_active'))
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.sort_order'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.visibility'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'public' => 'success',
                        'internal' => 'warning',
                        default => 'gray',
                    })
                    ->toggleable(),
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
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.is_active')),
                Tables\Filters\SelectFilter::make('visibility')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.categories.table.visibility'))
                    ->options([
                        'public' => __('filament-knowledge-base::knowledge-base.common.visibility.public'),
                        'internal' => __('filament-knowledge-base::knowledge-base.common.visibility.internal'),
                    ]),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
