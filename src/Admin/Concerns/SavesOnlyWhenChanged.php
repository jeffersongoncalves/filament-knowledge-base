<?php

namespace JeffersonGoncalves\FilamentKnowledgeBase\Admin\Concerns;

use Filament\Actions\Action;

/**
 * Save changes and Cancel only do something once the form has changes: until
 * then both are disabled and the floating action bar is hidden.
 *
 * Uses the saved-state hash Filament keeps for its "unsaved changes" warning
 * (refreshed after every save), so that warning is switched on for these
 * pages as well.
 */
trait SavesOnlyWhenChanged
{
    /** Browser-side: true while the form still matches what was last saved. */
    private const UNCHANGED_JS = "window.jsMd5(JSON.stringify(\$wire.data).replace(/\\\\/g, '')) === \$wire.savedDataHash";

    // A method, not the property: redeclaring Filament's property with another default is a fatal trait conflict.
    protected function hasUnsavedDataChangesAlert(): bool
    {
        return true;
    }

    protected function getSaveFormAction(): Action
    {
        return parent::getSaveFormAction()->extraAttributes([
            'x-bind:disabled' => 'isProcessing || '.self::UNCHANGED_JS,
            // Marks the bar as having nothing to save (see the plugin stylesheet).
            'x-bind:data-kb-unchanged' => self::UNCHANGED_JS,
        ]);
    }

    protected function getCancelFormAction(): Action
    {
        return parent::getCancelFormAction()->extraAttributes([
            'x-bind:disabled' => self::UNCHANGED_JS,
        ]);
    }
}
