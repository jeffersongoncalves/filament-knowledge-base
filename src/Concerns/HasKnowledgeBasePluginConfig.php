<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Concerns;

use BackedEnum;

trait HasKnowledgeBasePluginConfig
{
    protected bool $versioningEnabled = true;

    protected bool $feedbackEnabled = true;

    protected bool $relatedArticlesEnabled = true;

    protected bool $seoEnabled = true;

    protected ?string $navigationGroup = null;

    protected ?int $navigationSort = null;

    protected string|BackedEnum|null $navigationIcon = null;

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
}
