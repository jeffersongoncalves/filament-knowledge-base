<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\ArticleResource;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
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
                    RichEditor::make('content')
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
                ->schema([
                    TextInput::make('seo_title')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_title'))
                        ->maxLength(255),
                    Textarea::make('seo_description')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_description'))
                        ->rows(2),
                    TextInput::make('seo_keywords')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_keywords'))
                        ->maxLength(255),
                ])->columns(2)
                ->collapsible()
                ->collapsed();
        }

        return $schema
            ->columns(null)
            ->components($components);
    }
}
