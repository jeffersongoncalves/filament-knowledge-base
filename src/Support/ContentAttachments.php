<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Support;

use Error;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use JeffersonGoncalves\KnowledgeBase\Enums\AssetKind;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleContract;
use JeffersonGoncalves\KnowledgeBase\Support\ArticleAssets;
use JeffersonGoncalves\KnowledgeBase\Support\Locales;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

/**
 * Bridges the editor's file attachments and the core's article assets.
 *
 * Instead of letting Filament store uploads at the root of its default disk,
 * every upload goes through {@see ArticleAssets}, so images and files end up in
 * the article's own folder. The scope follows the tab the editor is in: an
 * upload in the default language's tab (or the single-language form) is shared,
 * an upload in another language's tab belongs to that language.
 *
 * Filament 3's editor (Trix) keeps only the URL of an attachment, so on save
 * {@see tagImages()} adds the asset id the core resolves images by.
 */
final class ContentAttachments
{
    /**
     * Livewire event sent after the editor stores an asset, so the asset
     * manager on the same page shows it without a reload.
     */
    public const ASSETS_CHANGED_EVENT = 'kb-article-assets-changed';

    public static function disk(): string
    {
        return (string) config('knowledge-base.attachments.disk', 'public');
    }

    public static function directory(): string
    {
        return trim((string) config('knowledge-base.attachments.directory', 'knowledge-base'), '/');
    }

    /**
     * @param  bool  $allowUploads  false on the create page, before the article
     *                              exists: the attach button is left out and
     *                              the form shows a "save first" hint.
     */
    public static function configure(RichEditor $editor, bool $allowUploads = true): RichEditor
    {
        // Readers see these files on public pages, so they are always public.
        $editor = $editor
            ->fileAttachmentsDisk(fn (): string => self::disk())
            ->fileAttachmentsDirectory(fn (): string => self::directory())
            ->fileAttachmentsVisibility('public')
            ->saveUploadedFileAttachmentsUsing(
                fn (TemporaryUploadedFile $file, RichEditor $component): ?string => self::store($component, $file),
            )
            ->getUploadedAttachmentUrlUsing(
                fn (mixed $file): ?string => self::url($file),
            );

        return $allowUploads ? $editor : $editor->disableToolbarButtons(['attachFiles']);
    }

    /**
     * Store an upload as an asset of the record the editor is editing and
     * return its uuid; the editor then receives the asset's URL.
     */
    public static function store(RichEditor $component, UploadedFile $file): ?string
    {
        $record = $component->getRecord();

        if (! $record instanceof Model || ! $record instanceof ArticleContract) {
            return null;
        }

        $asset = app(ArticleAssets::class)->store(
            $record,
            $file,
            self::kindFor((string) $file->getMimeType()),
            self::localeForStatePath($component->getStatePath(isAbsolute: false)),
        );

        self::notifyAssetsChanged($component);

        return (string) $asset->getAttribute('uuid');
    }

    /**
     * Tell the page the editor sits on that an asset was stored. An editor
     * outside a form (no page) has nobody to tell.
     */
    protected static function notifyAssetsChanged(RichEditor $component): void
    {
        try {
            $livewire = $component->getLivewire();
        } catch (Error) {
            return;
        }

        if ($livewire instanceof Component) {
            $livewire->dispatch(self::ASSETS_CHANGED_EVENT);
        }
    }

    /**
     * The current URL of an asset referenced by its uuid.
     */
    public static function url(mixed $file): ?string
    {
        if (! is_string($file) || $file === '') {
            return null;
        }

        $assetClass = ModelResolver::articleAsset();
        $asset = $assetClass::query()->where('uuid', $file)->first();

        return $asset instanceof Model ? app(ArticleAssets::class)->url($asset) : null;
    }

    /**
     * Give every image that shows one of the article's assets the asset's id
     * as `data-id`, so the core resolves its URL on render, reports where it is
     * used and notices when it is deleted. File links need nothing: the core
     * recognises them by their path.
     *
     * ponytail: matches the asset path inside `src`, which survives a changed
     * site address; Trix's own `data-trix-attachment` JSON keeps the old URL.
     */
    public static function tagImages(?string $html, Model $article): ?string
    {
        if ($html === null || ! str_contains($html, '<img') || ! $article instanceof ArticleContract) {
            return $html;
        }

        $assetClass = ModelResolver::articleAsset();
        $paths = $assetClass::query()
            ->where('article_id', $article->getKey())
            ->where('kind', AssetKind::Image)
            ->pluck('uuid', 'path')
            ->all();

        if ($paths === []) {
            return $html;
        }

        return preg_replace_callback('/<img\b[^>]*>/i', function (array $match) use ($paths): string {
            $tag = $match[0];

            if (str_contains($tag, 'data-id=') || preg_match('/\bsrc="([^"]*)"/i', $tag, $src) !== 1) {
                return $tag;
            }

            $url = urldecode((string) strtok(html_entity_decode($src[1]), '?#'));

            foreach ($paths as $path => $uuid) {
                if (str_contains($url, (string) $path)) {
                    return substr($tag, 0, 4).' data-id="'.e($uuid).'"'.substr($tag, 4);
                }
            }

            return $tag;
        }, $html) ?? $html;
    }

    /**
     * The language scope of an editor field: the tab's language for a
     * `translations.<locale>.content` field, otherwise null (shared).
     */
    public static function localeForStatePath(string $statePath): ?string
    {
        if (preg_match('/(?:^|\.)translations\.([^.]+)\.content$/', $statePath, $matches) === 1) {
            $locale = $matches[1];

            return Locales::isConfigured($locale) ? $locale : null;
        }

        return null;
    }

    /**
     * The kind of an upload, from its detected type: anything in the allowed
     * image types is an image, everything else a file.
     */
    public static function kindFor(string $mimeType): AssetKind
    {
        return in_array($mimeType, self::imageTypes(), true) ? AssetKind::Image : AssetKind::File;
    }

    /**
     * The accepted MIME types of both kinds; each kind is enforced again on
     * store.
     *
     * @return list<string>
     */
    public static function acceptedFileTypes(): array
    {
        return array_values(array_unique([...self::imageTypes(), ...self::fileTypes()]));
    }

    /**
     * The largest allowed size of either kind, in kilobytes.
     */
    public static function maxSize(): int
    {
        return max(
            (int) config('knowledge-base.attachments.images.max_size', 5120),
            (int) config('knowledge-base.attachments.files.max_size', 10240),
        );
    }

    /**
     * @return list<string>
     */
    public static function imageTypes(): array
    {
        /** @var list<string> $types */
        $types = (array) config('knowledge-base.attachments.images.accepted_types', ['image/jpeg', 'image/png', 'image/webp']);

        return $types;
    }

    /**
     * @return list<string>
     */
    public static function fileTypes(): array
    {
        /** @var list<string> $types */
        $types = (array) config('knowledge-base.attachments.files.accepted_types', ['application/pdf']);

        return $types;
    }
}
