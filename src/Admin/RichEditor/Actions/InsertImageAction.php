<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\RichEditor\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\EditorCommand;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Support\Enums\Width;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ContentAttachments;

/**
 * The "Insert image" editor tool (see design D10).
 *
 * The editor can upload a new image or choose one the article already has, in
 * the same scope as the tab it is in, and gets alt text. The chosen image is
 * stored as an article asset and inserted with the asset uuid as its `data-id`,
 * so every load re-resolves the URL (see ContentAttachments).
 */
class InsertImageAction
{
    public const NAME = 'insertImage';

    public static function make(): Action
    {
        $insert = Action::make(self::NAME)
            ->label(__('filament-knowledge-base::knowledge-base.admin.assets.insert_image.label'))
            ->modalHeading(__('filament-knowledge-base::knowledge-base.admin.assets.insert_image.modal.heading'))
            ->modalWidth(Width::Large)
            ->fillForm(fn (array $arguments): array => [
                'alt' => $arguments['alt'] ?? null,
            ])
            ->schema(function (array $arguments, RichEditor $component): array {
                $choices = self::existingImages($component);

                return [
                    ContentAttachments::chooseOrUpload(
                        $choices,
                        ViewField::make('existing'),
                        FileUpload::make('file')
                            ->image()
                            ->acceptedFileTypes(ContentAttachments::imageTypes())
                            ->maxSize(ContentAttachments::imageMaxSize())
                            ->storeFiles(false)
                            // Needed only for a new image that isn't chosen from the existing ones.
                            ->required(fn (Get $get): bool => blank($arguments['src'] ?? null) && blank($get('existing')))
                            ->markAsRequired(false),
                        'filament-knowledge-base::knowledge-base.admin.assets.insert_image.modal',
                    ),
                    TextInput::make('alt')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.assets.insert_image.modal.alt'))
                        ->helperText(__('filament-knowledge-base::knowledge-base.admin.assets.insert_image.modal.alt_help'))
                        ->maxLength(1000),
                ];
            })
            ->action(function (array $arguments, array $data, RichEditor $component): void {
                [$id, $src] = self::resolveImage($component, $arguments, $data);

                if (blank($id) || blank($src)) {
                    return;
                }

                if (filled($arguments['src'] ?? null)) {
                    // Editing an image already in the content.
                    $component->runCommands(
                        [EditorCommand::make('updateAttributes', arguments: [
                            'image',
                            ['alt' => $data['alt'] ?? null, 'id' => $id, 'src' => $src],
                        ])],
                        editorSelection: $arguments['editorSelection'],
                    );

                    return;
                }

                $component->runCommands(
                    [EditorCommand::make('insertContent', arguments: [[
                        'type' => 'image',
                        'attrs' => ['alt' => $data['alt'] ?? null, 'id' => $id, 'src' => $src],
                    ]])],
                    editorSelection: $arguments['editorSelection'],
                );
            });

        // "Insert", and only once an image is chosen or uploaded (editing an
        // image that is already in the text can always be confirmed).
        // Filament passes the confirm button as \$action; it is not the dialog's own action.
        return $insert->modalSubmitAction(fn (Action $action): Action => $action
            ->label(__('filament-knowledge-base::knowledge-base.admin.assets.insert_image.modal.submit'))
            ->disabled(fn (): bool => blank($insert->getArguments()['src'] ?? null)
                && ! ContentAttachments::hasSource($insert->getRawData())));
    }

    /**
     * The article's shared images plus the ones of the tab's language, as
     * uuid => card data for the thumbnail picker.
     *
     * @return array<string, array{name: string, url: ?string, size: string, scope: string}>
     */
    protected static function existingImages(RichEditor $component): array
    {
        return ContentAttachments::imageChoices($component);
    }

    /**
     * @param  array<string, mixed>  $arguments
     * @param  array<string, mixed>  $data
     * @return array{0: ?string, 1: ?string} the asset id and its URL
     */
    protected static function resolveImage(RichEditor $component, array $arguments, array $data): array
    {
        if (filled($data['file'] ?? null)) {
            $id = ContentAttachments::store($component, $data['file']);

            return [$id, ContentAttachments::url($id)];
        }

        // Only an image this tab offers: the uuid comes from the browser.
        $existing = (string) ($data['existing'] ?? '');

        if ($existing !== '' && array_key_exists($existing, self::existingImages($component))) {
            return [$existing, ContentAttachments::url($existing)];
        }

        if (filled($arguments['src'] ?? null)) {
            return [$arguments['id'] ?? null, $arguments['src']];
        }

        return [null, null];
    }
}
