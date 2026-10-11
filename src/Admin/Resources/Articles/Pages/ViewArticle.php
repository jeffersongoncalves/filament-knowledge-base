<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\EmbeddedSchema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Actions\ViewOnSiteAction;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\ArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Schemas\ArticleInfolist;

class ViewArticle extends ViewRecord
{
    protected static string $resource = ArticleResource::class;

    /**
     * The article full width at the top; below it one row of tabs with its
     * details (status, visibility, statistics, SEO), assets, versions,
     * feedback and related articles.
     */
    public function content(Schema $schema): Schema
    {
        return $schema->components([
            $this->getInfolistContentComponent(),
            Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.details.heading'))
                ->description(__('filament-knowledge-base::knowledge-base.admin.articles.details.description'))
                ->contained(false)
                ->extraAttributes(['class' => 'kb-article-tools'])
                ->schema([$this->getRelationManagersContentComponent()]),
        ]);
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return true;
    }

    public function getContentTabLabel(): ?string
    {
        return __('filament-knowledge-base::knowledge-base.admin.articles.details.details_tab');
    }

    public function getContentTabComponent(): Tab
    {
        return Tab::make($this->getContentTabLabel())
            ->schema([EmbeddedSchema::make('detailsInfolist')]);
    }

    public function detailsInfolist(Schema $schema): Schema
    {
        return ArticleInfolist::details($schema)->record($this->getRecord());
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewOnSiteAction::make(),
            Actions\EditAction::make(),
        ];
    }
}
