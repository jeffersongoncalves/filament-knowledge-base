<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Concerns;

use BackedEnum;
use Closure;
use Illuminate\Database\Eloquent\Model;

trait HasKnowledgeBasePluginConfig
{
    protected bool $versioningEnabled = true;

    protected bool $feedbackEnabled = true;

    protected bool $relatedArticlesEnabled = true;

    protected bool $seoEnabled = true;

    protected ?string $navigationGroup = null;

    protected ?int $navigationSort = null;

    protected string|BackedEnum|null $navigationIcon = null;

    /** @var (Closure(Model, string): ?string)|null */
    protected ?Closure $publicUrlUsing = null;

    public function versioning(bool $enabled = true): static
    {
        $this->versioningEnabled = $enabled;

        return $this;
    }

    public function hasVersioning(): bool
    {
        return $this->versioningEnabled && config('filament-knowledge-base.features.versioning', true);
    }

    public function feedback(bool $enabled = true): static
    {
        $this->feedbackEnabled = $enabled;

        return $this;
    }

    public function hasFeedback(): bool
    {
        return $this->feedbackEnabled && config('filament-knowledge-base.features.feedback', true);
    }

    public function relatedArticles(bool $enabled = true): static
    {
        $this->relatedArticlesEnabled = $enabled;

        return $this;
    }

    public function hasRelatedArticles(): bool
    {
        return $this->relatedArticlesEnabled && config('filament-knowledge-base.features.related_articles', true);
    }

    public function seo(bool $enabled = true): static
    {
        $this->seoEnabled = $enabled;

        return $this;
    }

    public function hasSeo(): bool
    {
        return $this->seoEnabled && config('filament-knowledge-base.features.seo', true);
    }

    public function navigationGroup(string $group): static
    {
        $this->navigationGroup = $group;

        return $this;
    }

    public function getNavigationGroup(): ?string
    {
        return $this->navigationGroup;
    }

    public function navigationSort(?int $sort): static
    {
        $this->navigationSort = $sort;

        return $this;
    }

    public function getNavigationSort(): ?int
    {
        return $this->navigationSort;
    }

    public function navigationIcon(string|BackedEnum $icon): static
    {
        $this->navigationIcon = $icon;

        return $this;
    }

    public function getNavigationIcon(): string|BackedEnum|null
    {
        return $this->navigationIcon;
    }

    /**
     * How an article's public page is reached, for the "View on site" button:
     * a callback receiving the article and a language that returns the URL
     * (or null when there is none). The package has no public pages of its
     * own, so the app that renders them provides this.
     *
     * @param  (Closure(Model, string): ?string)|null  $callback
     */
    public function publicUrlUsing(?Closure $callback): static
    {
        $this->publicUrlUsing = $callback;

        return $this;
    }

    public function hasPublicUrls(): bool
    {
        return $this->publicUrlUsing !== null;
    }

    public function getPublicUrl(Model $article, string $locale): ?string
    {
        return $this->publicUrlUsing ? ($this->publicUrlUsing)($article, $locale) : null;
    }
}
