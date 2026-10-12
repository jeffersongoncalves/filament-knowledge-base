<?php

use Filament\Forms\Components\RichEditor;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ContentAttachments;

it('stores editor files in the knowledge base directory on the private local disk by default', function () {
    config(['knowledge-base.attachments' => null]);

    $editor = ContentAttachments::configure(RichEditor::make('content'));

    expect($editor->getFileAttachmentsDiskName())->toBe('local')
        ->and($editor->getFileAttachmentsDirectory())->toBe('knowledge-base')
        ->and($editor->getFileAttachmentsVisibility())->toBe('private');
});

it('follows the core attachments setting', function () {
    config(['knowledge-base.attachments' => ['disk' => 's3', 'directory' => 'help/files']]);

    $editor = ContentAttachments::configure(RichEditor::make('content'));

    expect($editor->getFileAttachmentsDiskName())->toBe('s3')
        ->and($editor->getFileAttachmentsDirectory())->toBe('help/files');
});
