<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Concerns\SavesOnlyWhenChanged;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\ArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\Pages\Concerns\ManagesArticleTranslations;

class EditArticle extends EditRecord
{
    use ManagesArticleTranslations;
    use SavesOnlyWhenChanged;

    protected static string $resource = ArticleResource::class;

    // Save and Cancel stay in view while editing a long form.
    public static bool $formActionsAreSticky = true;

    /**
     * The form with its Save button, then the article's files, history and
     * feedback as a separate area with its own heading.
     */
    public function content(Schema $schema): Schema
    {
        return $schema->components([
            $this->getFormContentComponent(),
            Section::make(__('filament-knowledge-base::knowledge-base.admin.articles.tools.heading'))
                ->description(__('filament-knowledge-base::knowledge-base.admin.articles.tools.description'))
                ->contained(false)
                ->extraAttributes(['class' => 'kb-article-tools'])
                ->schema([$this->getRelationManagersContentComponent()]),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
