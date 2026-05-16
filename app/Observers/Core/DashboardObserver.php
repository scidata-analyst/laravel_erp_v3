<?php

namespace App\Observers\Core;

use App\Models\Core\Dashboard;

class DashboardObserver
{
    /**
     * Handle the Dashboard "created" event.
     */
    public function created(Dashboard $dashboard): void
    {
        //
    }

    /**
     * Handle the Dashboard "updated" event.
     */
    public function updated(Dashboard $dashboard): void
    {
        //
    }

    /**
     * Handle the Dashboard "deleted" event.
     */
    public function deleted(Dashboard $dashboard): void
    {
        //
    }

    /**
     * Handle the Dashboard "restored" event.
     */
    public function restored(Dashboard $dashboard): void
    {
        //
    }

    /**
     * Handle the Dashboard "force deleted" event.
     */
    public function forceDeleted(Dashboard $dashboard): void
    {
        //
    }
}
