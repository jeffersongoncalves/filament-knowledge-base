<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\ArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ArticleBadge;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleStatus;
use JeffersonGoncalves\KnowledgeBase\Enums\ArticleVisibility;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleContract;
use JeffersonGoncalves\KnowledgeBase\Support\ArticleAssets;

class ArticleInfolist
{
    /**
     * The article itself, full width: what readers get.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_content'))
                    ->extraAttributes(['class' => 'kb-article-view'])
                    ->schema([
                        TextEntry::make('title')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.title'))
                            ->extraAttributes(['class' => 'kb-entry-title']),
                        TextEntry::make('slug')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.slug')),
                        TextEntry::make('category.name')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.category')),
                        // Prose: headings, lists and images get their usual spacing.
                        // Asset references point at their current URLs: the stored
                        // ones may be another address or an expired signed URL.
                        TextEntry::make('content')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.content'))
                            ->formatStateUsing(fn (?string $state, Model&ArticleContract $record): string => app(ArticleAssets::class)->resolve((string) $state, $record))
                            ->html()
                            ->prose()
                            ->columnSpanFull(),
                        TextEntry::make('excerpt')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.excerpt'))
                            ->columnSpanFull(),
                    ])->columns(3),
            ]);
    }

    /**
     * Status, visibility, counts and SEO: shown in the Details tab next to
     * the article's assets, versions and feedback.
     */
    public static function details(Schema $schema): Schema
    {
        $components = [
            Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.form.section_settings'))
                ->extraAttributes(['class' => 'kb-article-view'])
                ->schema([
                    TextEntry::make('status')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.status'))
                        ->badge()
                        ->color(fn (ArticleStatus|string|null $state): string => ArticleBadge::statusColor($state))
                        ->formatStateUsing(fn (ArticleStatus|string|null $state): string => ArticleBadge::statusLabel($state)),
                    TextEntry::make('visibility')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.visibility'))
                        ->badge()
                        ->color(fn (ArticleVisibility|string|null $state): string => ArticleBadge::visibilityColor($state))
                        ->formatStateUsing(fn (ArticleVisibility|string|null $state): string => ArticleBadge::visibilityLabel($state)),
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
                ->extraAttributes(['class' => 'kb-article-view'])
                ->schema([
                    TextEntry::make('seo_title')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_title')),
                    TextEntry::make('seo_description')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_description')),
                    TextEntry::make('seo_keywords')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.articles.form.seo_keywords')),
                ])->columns(3);
        }

        return $schema->columns(1)->components($components);
    }
}
