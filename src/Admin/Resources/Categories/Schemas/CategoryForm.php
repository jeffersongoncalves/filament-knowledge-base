<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
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
                    ->schema([
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
                    ])->columns(2),
            ]);
    }
}
