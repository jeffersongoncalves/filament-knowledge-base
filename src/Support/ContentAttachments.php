<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Support;

use Error;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\RichEditorTool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\RichEditor\Actions\AttachFileAction;
use JeffersonGoncalves\FilamentKnowledgeBase\Admin\RichEditor\Actions\InsertImageAction;
use JeffersonGoncalves\KnowledgeBase\Enums\AssetKind;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleAssetContract;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleContract;
use JeffersonGoncalves\KnowledgeBase\Support\ArticleAssets;
use JeffersonGoncalves\KnowledgeBase\Support\Locales;
use JeffersonGoncalves\KnowledgeBase\Support\ModelResolver;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

/**
 * Bridges the editor's file attachments and the core's article assets
 * (see design D10).
 *
 * Instead of letting Filament store uploads at the root of its default disk,
 * every upload goes through {@see ArticleAssets}, so images and files end up in
 * the article's own folder. The scope follows the tab the editor is in: an
 * upload in the default language's tab (or the single-language form) is shared,
 * an upload in another language's tab belongs to that language.
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
     *                              exists: the tools are left out and the form
     *                              shows a "save first" hint (see design D10).
     */
    public static function configure(RichEditor $editor, bool $allowUploads = true): RichEditor
    {
        // Readers see these files on public pages, so they are always public.
        $editor = $editor
            ->fileAttachmentsDisk(fn (): string => self::disk())
            ->fileAttachmentsDirectory(fn (): string => self::directory())
            ->fileAttachmentsVisibility('public')
            ->fileAttachmentsAcceptedFileTypes(fn (): array => self::acceptedFileTypes())
            ->fileAttachmentsMaxSize(fn (): int => self::maxSize())
            ->saveUploadedFileAttachmentUsing(
                fn (TemporaryUploadedFile $file, RichEditor $component): ?string => self::store($component, $file),
            )
            ->getFileAttachmentUrlUsing(
                fn (mixed $file): ?string => self::url($file),
            )
            // Filament's paperclip is never used: it would store at the root of
            // its default disk instead of in the article's folder.
            ->disableToolbarButtons(['attachFiles']);

        if (! $allowUploads) {
            return $editor;
        }

        return $editor
            ->tools([
                RichEditorTool::make(InsertImageAction::NAME)
                    ->label(__('filament-knowledge-base::knowledge-base.admin.assets.insert_image.label'))
                    ->icon('heroicon-o-photo')
                    ->action(InsertImageAction::NAME),
                RichEditorTool::make(AttachFileAction::NAME)
                    ->label(__('filament-knowledge-base::knowledge-base.admin.assets.attach_file.label'))
                    ->icon('heroicon-o-paper-clip')
                    ->action(AttachFileAction::NAME),
            ])
            ->registerActions([
                InsertImageAction::make(),
                AttachFileAction::make(),
            ])
            ->enableToolbarButtons([InsertImageAction::NAME, AttachFileAction::NAME]);
    }

    /**
     * The article's images a tab may reuse: its shared images plus the ones of
     * that language, as uuid => thumbnail for the "choose existing" picker.
     *
     * @return array<string, HtmlString>
     */
    public static function imageChoices(RichEditor $component): array
    {
        return self::choices($component, AssetKind::Image)
            ->mapWithKeys(function (Model $asset): array {
                $name = e((string) $asset->getAttribute('original_name'));
                $url = e(self::url((string) $asset->getAttribute('uuid')) ?? '');

                return [(string) $asset->getAttribute('uuid') => new HtmlString(
                    '<img src="'.$url.'" alt="" style="height: 1.5rem; width: 1.5rem; object-fit: cover; border-radius: 0.25rem; vertical-align: middle; margin-right: 0.5rem;">'.$name
                )];
            })
            ->all();
    }

    /**
     * The article's files a tab may reuse, as uuid => name.
     *
     * @return array<string, string>
     */
    public static function fileChoices(RichEditor $component): array
    {
        return self::choices($component, AssetKind::File)
            ->mapWithKeys(fn (Model $asset): array => [
                (string) $asset->getAttribute('uuid') => (string) $asset->getAttribute('original_name'),
            ])
            ->all();
    }

    /**
     * The asset with the given uuid, or null.
     */
    public static function asset(string $uuid): ?Model
    {
        $assetClass = ModelResolver::articleAsset();
        $asset = $assetClass::query()->where('uuid', $uuid)->first();

        return $asset instanceof Model ? $asset : null;
    }

    public static function imageMaxSize(): int
    {
        return (int) config('knowledge-base.attachments.images.max_size', 5120);
    }

    public static function fileMaxSize(): int
    {
        return (int) config('knowledge-base.attachments.files.max_size', 10240);
    }

    /**
     * The assets of the given kind an editor may reuse in the tab it is in:
     * the record's shared assets plus the tab's language.
     *
     * @return Collection<int, Model&ArticleAssetContract>
     */
    protected static function choices(RichEditor $component, AssetKind $kind): Collection
    {
        $record = $component->getRecord();

        if (! $record instanceof Model || ! $record instanceof ArticleContract) {
            return new Collection;
        }

        $locale = self::localeForStatePath((string) $component->getStatePath(isAbsolute: false));

        $assetClass = ModelResolver::articleAsset();

        return $assetClass::query()
            ->where('article_id', $record->getKey())
            ->where('kind', $kind)
            ->where(function ($query) use ($locale): void {
                $query->whereNull('locale');

                if ($locale !== null) {
                    $query->orWhere('locale', $locale);
                }
            })
            ->orderBy('original_name')
            ->get();
    }

    /**
     * Store an upload as an asset of the record the editor is editing and
     * return its uuid, which Filament keeps next to the image.
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
            self::localeForStatePath((string) $component->getStatePath(isAbsolute: false)),
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

        $livewire->dispatch(self::ASSETS_CHANGED_EVENT);
    }

    /**
     * The current URL of an asset referenced by its uuid, read on every load so
     * it always matches the current site address (design D5).
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
     * The accepted MIME types of both kinds, so the editor's temporary uploads
     * may carry images and files; each kind is enforced again on store.
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
