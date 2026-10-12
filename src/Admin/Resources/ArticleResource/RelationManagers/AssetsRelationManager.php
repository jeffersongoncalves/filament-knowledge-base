<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\ArticleResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\AssetUsage;
use JeffersonGoncalves\FilamentKnowledgeBase\Support\ContentAttachments;
use JeffersonGoncalves\KnowledgeBase\Enums\AssetKind;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleAssetContract;
use JeffersonGoncalves\KnowledgeBase\Models\Contracts\ArticleContract;
use JeffersonGoncalves\KnowledgeBase\Support\ArticleAssets;
use Livewire\Attributes\On;

/**
 * The asset manager on the article's pages: a grid of thumbnails (a file icon
 * for files) with the asset's name, size, scope and where it is used,
 * filterable by scope, with upload and delete actions.
 */
class AssetsRelationManager extends RelationManager
{
    protected static string $relationship = 'assets';

    /** A neutral document icon, shown instead of a thumbnail for files. */
    protected const FILE_ICON = 'data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%236b7280" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/></svg>';

    /**
     * The editor stored an asset on this page: show it straight away.
     */
    #[On(ContentAttachments::ASSETS_CHANGED_EVENT)]
    public function refreshAssets(): void
    {
        $this->flushCachedTableRecords();
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.assets.manager.title');
    }

    public function table(Table $table): Table
    {
        return $table
            ->contentGrid(['md' => 2, 'xl' => 3])
            ->columns([
                Stack::make([
                    // Images by the core's URL, which works on a private disk (a
                    // signed URL for an article that isn't public), made absolute
                    // because a relative URL would be taken for a path on the
                    // default disk; files show a document icon instead.
                    ImageColumn::make('preview')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.preview'))
                        ->state(fn (Model&ArticleAssetContract $record): ?string => $record->kind() === AssetKind::Image ? url(app(ArticleAssets::class)->url($record)) : null)
                        ->defaultImageUrl(self::FILE_ICON)
                        ->height(120),
                    TextColumn::make('original_name')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.name'))
                        ->weight(FontWeight::SemiBold)
                        ->searchable()
                        ->limit(50),
                    TextColumn::make('size')
                        ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.size'))
                        ->color('gray')
                        ->state(fn (Model&ArticleAssetContract $record): string => Number::fileSize((int) $record->getAttribute('size'))),
                    Split::make([
                        TextColumn::make('scope')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.scope'))
                            ->badge()
                            ->grow(false)
                            ->state(fn (Model&ArticleAssetContract $record): string => AssetUsage::scopeLabel($record)),
                        TextColumn::make('usage')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.usage'))
                            ->badge()
                            ->color(fn (Model&ArticleAssetContract $record): string => app(ArticleAssets::class)->usage($record) === [] ? 'warning' : 'success')
                            ->state(fn (Model&ArticleAssetContract $record): string => AssetUsage::usageLabel($record)),
                    ]),
                ])->space(2),
            ])
            ->filters([
                SelectFilter::make('scope')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.scope'))
                    ->options(AssetUsage::scopeOptions())
                    ->query(function ($query, array $data) {
                        $scope = $data['value'] ?? null;

                        if ($scope === 'shared') {
                            return $query->whereNull('locale');
                        }

                        if (is_string($scope) && $scope !== '') {
                            return $query->where('locale', $scope);
                        }

                        return $query;
                    }),
            ])
            ->headerActions([
                Tables\Actions\Action::make('upload')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.upload'))
                    ->icon('heroicon-o-arrow-up-tray')
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.file'))
                            ->acceptedFileTypes(ContentAttachments::acceptedFileTypes())
                            ->maxSize(ContentAttachments::maxSize())
                            ->storeFiles(false)
                            ->required(),
                        Forms\Components\Select::make('kind')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.kind'))
                            ->options([
                                AssetKind::Image->value => __('knowledge-base::knowledge-base.asset_kind.image'),
                                AssetKind::File->value => __('knowledge-base::knowledge-base.asset_kind.file'),
                            ])
                            ->default(AssetKind::Image->value)
                            ->required(),
                        Forms\Components\Select::make('scope')
                            ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.scope'))
                            ->options(AssetUsage::scopeOptions())
                            ->default('shared')
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        $owner = $this->getOwnerRecord();

                        if (! $owner instanceof ArticleContract) {
                            return;
                        }

                        app(ArticleAssets::class)->store(
                            $owner,
                            $data['file'],
                            AssetKind::from((string) $data['kind']),
                            $data['scope'] === 'shared' ? null : (string) $data['scope'],
                        );
                    }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->modalDescription(fn (Model&ArticleAssetContract $record): string => AssetUsage::deleteWarning($record))
                    ->using(function (Model&ArticleAssetContract $record): bool {
                        app(ArticleAssets::class)->delete($record);

                        return true;
                    }),
            ]);
    }
}
