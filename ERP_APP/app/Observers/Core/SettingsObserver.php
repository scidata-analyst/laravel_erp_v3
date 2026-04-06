<?php

namespace App\Observers\Core;

use App\Models\Core\Settings;

class SettingsObserver
{
    /**
     * Handle the Settings "created" event.
     */
    public function created(Settings $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Settings "updated" event.
     */
    public function updated(Settings $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Settings "deleted" event.
     */
    public function deleted(Settings $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Settings "restored" event.
     */
    public function restored(Settings $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Settings "forceDeleted" event.
     */
    public function forceDeleted(Settings $modelVar): void
    {
        // ...
    }
}
