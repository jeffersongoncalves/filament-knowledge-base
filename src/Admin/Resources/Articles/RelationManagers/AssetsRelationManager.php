<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Resources\Articles\RelationManagers;

use Filament\Actions;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\ImageColumn;
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

/**
 * The asset manager on the article's edit page (see design D10): a grid of
 * thumbnails (a file icon for files) with the asset's name, size, scope and
 * where it is used, filterable by scope, with upload and delete actions.
 */
class AssetsRelationManager extends RelationManager
{
    protected static string $relationship = 'assets';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('filament-knowledge-base::knowledge-base.admin.assets.manager.title');
    }

    public function table(Table $table): Table
    {
        return $table
            ->contentGrid(['md' => 2, 'xl' => 3])
            ->columns([
                ImageColumn::make('preview')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.preview'))
                    ->state(fn (Model&ArticleAssetContract $record): ?string => self::previewUrl($record))
                    ->imageHeight(80),
                TextColumn::make('original_name')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.name'))
                    ->searchable()
                    ->limit(50),
                TextColumn::make('size')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.size'))
                    ->state(fn (Model&ArticleAssetContract $record): string => Number::fileSize((int) $record->getAttribute('size'))),
                TextColumn::make('scope')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.scope'))
                    ->badge()
                    ->state(fn (Model&ArticleAssetContract $record): string => AssetUsage::scopeLabel($record)),
                TextColumn::make('usage')
                    ->label(__('filament-knowledge-base::knowledge-base.admin.assets.manager.usage'))
                    ->badge()
                    ->state(fn (Model&ArticleAssetContract $record): string => AssetUsage::usageLabel($record)),
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
                Actions\Action::make('upload')
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
            ->recordActions([
                Actions\DeleteAction::make()
                    ->modalDescription(fn (Model&ArticleAssetContract $record): string => AssetUsage::deleteWarning($record)),
            ]);
    }

    /**
     * The thumbnail URL for an image, or null so the file icon shows.
     */
    protected static function previewUrl(Model&ArticleAssetContract $asset): ?string
    {
        if ($asset->kind() !== AssetKind::Image) {
            return null;
        }

        return app(ArticleAssets::class)->url($asset);
    }
}
