<?php

namespace App\Observers\Core;

use App\Models\Core\Dashboard;

class DashboardObserver
{
    /**
     * Handle the Dashboard "created" event.
     */
    public function created(Dashboard $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Dashboard "updated" event.
     */
    public function updated(Dashboard $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Dashboard "deleted" event.
     */
    public function deleted(Dashboard $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Dashboard "restored" event.
     */
    public function restored(Dashboard $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Dashboard "forceDeleted" event.
     */
    public function forceDeleted(Dashboard $modelVar): void
    {
        // ...
    }
}
