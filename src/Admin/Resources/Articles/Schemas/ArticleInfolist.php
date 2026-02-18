<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\ArticleResource;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;

class ArticleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        $components = [
            Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_content'))
                ->schema([
                    TextEntry::make('title')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.title')),
                    TextEntry::make('slug')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.slug')),
                    TextEntry::make('category.name')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.category')),
                    TextEntry::make('content')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.content'))
                        ->html()
                        ->columnSpanFull(),
                    TextEntry::make('excerpt')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.excerpt'))
                        ->columnSpanFull(),
                ])->columns(2),

            Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_settings'))
                ->schema([
                    TextEntry::make('status')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.status'))
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            ArticleStatus::Draft->value => 'gray',
                            ArticleStatus::Published->value => 'success',
                            ArticleStatus::Archived->value => 'danger',
                            default => 'gray',
                        }),
                    TextEntry::make('visibility')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.visibility'))
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'public' => 'success',
                            'internal' => 'warning',
                            default => 'gray',
                        }),
                    TextEntry::make('published_at')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.published_at'))
                        ->dateTime(),
                    TextEntry::make('view_count')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.table.view_count')),
                    TextEntry::make('helpful_count')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.infolist.helpful_count')),
                    TextEntry::make('not_helpful_count')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.infolist.not_helpful_count')),
                    TextEntry::make('current_version')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.infolist.current_version')),
                    TextEntry::make('created_at')
                        ->label(__('filament-knowledge-base::knowledge-base.common.created_at'))
                        ->dateTime(),
                    TextEntry::make('updated_at')
                        ->label(__('filament-knowledge-base::knowledge-base.common.updated_at'))
                        ->dateTime(),
                ])->columns(3),
        ];

        if (ArticleResource::hasSeo()) {
            $components[] = Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_seo'))
                ->schema([
                    TextEntry::make('seo_title')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_title')),
                    TextEntry::make('seo_description')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_description')),
                    TextEntry::make('seo_keywords')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_keywords')),
                ])->columns(3)
                ->collapsible()
                ->collapsed();
        }

        return $schema->schema($components);
    }
}
