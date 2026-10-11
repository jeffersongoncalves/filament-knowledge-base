<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\RichEditor\Actions;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\RichEditor\EditorCommand;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Support\Enums\Width;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ContentAttachments;

/**
 * The "Attach file" editor tool (see design D10).
 *
 * The editor can upload a new file or choose one the article already has and
 * gets a download link showing the file name and a human-readable size. The
 * link points at the asset's current URL; its asset path identifies the asset
 * on the next render (see ArticleAssets::resolve()).
 */
class AttachFileAction
{
    public const NAME = 'attachFile';

    public static function make(): Action
    {
        $attach = Action::make(self::NAME)
            ->label(__('filament-knowledge-base::knowledge-base.admin.assets.attach_file.label'))
            ->modalHeading(__('filament-knowledge-base::knowledge-base.admin.assets.attach_file.modal.heading'))
            ->modalWidth(Width::Large)
            ->schema(function (RichEditor $component): array {
                $choices = ContentAttachments::fileChoices($component);

                return [
                    ContentAttachments::chooseOrUpload(
                        $choices,
                        ViewField::make('existing'),
                        FileUpload::make('file')
                            ->acceptedFileTypes(ContentAttachments::fileTypes())
                            ->maxSize(ContentAttachments::fileMaxSize())
                            ->storeFiles(false)
                            // Needed only when no existing file is chosen.
                            ->required(fn (Get $get): bool => blank($get('existing')))
                            ->markAsRequired(false),
                        'filament-knowledge-base::knowledge-base.admin.assets.attach_file.modal',
                    ),
                ];
            })
            ->action(function (array $arguments, array $data, RichEditor $component): void {
                $asset = self::resolveFile($component, $data);

                if (! $asset instanceof Model) {
                    return;
                }

                $url = ContentAttachments::url((string) $asset->getAttribute('uuid'));

                if (blank($url)) {
                    return;
                }

                $text = (string) $asset->getAttribute('original_name')
                    .', '.Number::fileSize((int) $asset->getAttribute('size'));

                $component->runCommands(
                    [EditorCommand::make('insertContent', arguments: [[
                        'type' => 'text',
                        'text' => $text,
                        'marks' => [['type' => 'link', 'attrs' => ['href' => $url]]],
                    ]])],
                    editorSelection: $arguments['editorSelection'],
                );
            });

        // "Attach", and only once a file is chosen or uploaded.
        // Filament passes the confirm button as \$action; it is not the dialog's own action.
        return $attach->modalSubmitAction(fn (Action $action): Action => $action
            ->label(__('filament-knowledge-base::knowledge-base.admin.assets.attach_file.modal.submit'))
            ->disabled(fn (): bool => ! ContentAttachments::hasSource($attach->getRawData())));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected static function resolveFile(RichEditor $component, array $data): ?Model
    {
        if (filled($data['file'] ?? null)) {
            $uuid = ContentAttachments::store($component, $data['file']);

            return is_string($uuid) ? ContentAttachments::asset($uuid) : null;
        }

        if (filled($data['existing'] ?? null)) {
            return ContentAttachments::asset((string) $data['existing']);
        }

        return null;
    }
}
