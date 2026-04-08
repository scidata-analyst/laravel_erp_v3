<?php

namespace App\Observers\Core;

use App\Models\Core\Settings;

class SettingsObserver
{
    /**
     * Handle the Settings "created" event.
     */
    public function created(Settings $settings): void
    {
        //
    }

    /**
     * Handle the Settings "updated" event.
     */
    public function updated(Settings $settings): void
    {
        //
    }

    /**
     * Handle the Settings "deleted" event.
     */
    public function deleted(Settings $settings): void
    {
        //
    }

    /**
     * Handle the Settings "restored" event.
     */
    public function restored(Settings $settings): void
    {
        //
    }

    /**
     * Handle the Settings "force deleted" event.
     */
    public function forceDeleted(Settings $settings): void
    {
        //
    }
}
