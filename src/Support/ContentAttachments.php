<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Support;

use Filament\Forms\Components\RichEditor;

/**
 * Where files added in the article editor are stored: the core's
 * `knowledge-base.attachments` setting, so every knowledge base file lives
 * under one directory instead of the root of Filament's default disk.
 */
final class ContentAttachments
{
    public static function disk(): string
    {
        return (string) config('knowledge-base.attachments.disk', 'public');
    }

    public static function directory(): string
    {
        return (string) config('knowledge-base.attachments.directory', 'knowledge-base/attachments');
    }

    public static function configure(RichEditor $editor): RichEditor
    {
        // Readers see these files on public pages, so they are always public.
        return $editor
            ->fileAttachmentsDisk(fn (): string => self::disk())
            ->fileAttachmentsDirectory(fn (): string => self::directory())
            ->fileAttachmentsVisibility('public');
    }
}
