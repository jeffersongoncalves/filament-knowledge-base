<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\Actions;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\TranslationForm;
use Locale;

/**
 * "View on site": opens the article's public page in a new tab, one entry per
 * language. Shown only when the app told the plugin how public URLs look
 * (publicUrlUsing()) and customers can see the article.
 */
final class ViewOnSiteAction
{
    public static function make(): Action|ActionGroup
    {
        $locales = TranslationForm::locales();

        if (count($locales) === 1) {
            return self::forLocale($locales[0])
                ->label(__('filament-knowledge-base::knowledge-base.admin.articles.actions.view_on_site'))
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray');
        }

        return ActionGroup::make(array_map(fn (string $locale): Action => self::forLocale($locale), $locales))
            ->label(__('filament-knowledge-base::knowledge-base.admin.articles.actions.view_on_site'))
            ->icon('heroicon-o-arrow-top-right-on-square')
            ->color('gray')
            ->button();
    }

    protected static function forLocale(string $locale): Action
    {
        return Action::make('viewOnSite'.Str::studly($locale))
            ->label(self::languageName($locale))
            ->url(fn (?Model $record): ?string => $record ? ArticleResource::publicUrl($record, $locale) : null)
            ->openUrlInNewTab()
            // The group hides itself once all its languages are hidden.
            ->visible(fn (?Model $record): bool => $record && ArticleResource::publicUrl($record, $locale) !== null);
    }

    protected static function languageName(string $locale): string
    {
        if (class_exists(Locale::class)) {
            $name = Locale::getDisplayLanguage($locale, app()->getLocale());

            if ($name !== false && $name !== $locale) {
                return Str::ucfirst($name).' ('.strtoupper($locale).')';
            }
        }

        return strtoupper($locale);
    }
}
