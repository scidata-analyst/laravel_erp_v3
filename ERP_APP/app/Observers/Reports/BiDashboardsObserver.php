<?php

namespace App\Observers\Reports;

use App\Models\Reports\BiDashboards;

class BiDashboardsObserver
{
    /**
     * Handle the BiDashboards "created" event.
     */
    public function created(BiDashboards $modelVar): void
    {
        // ...
    }

    /**
     * Handle the BiDashboards "updated" event.
     */
    public function updated(BiDashboards $modelVar): void
    {
        // ...
    }

    /**
     * Handle the BiDashboards "deleted" event.
     */
    public function deleted(BiDashboards $modelVar): void
    {
        // ...
    }

    /**
     * Handle the BiDashboards "restored" event.
     */
    public function restored(BiDashboards $modelVar): void
    {
        // ...
    }

    /**
     * Handle the BiDashboards "forceDeleted" event.
     */
    public function forceDeleted(BiDashboards $modelVar): void
    {
        // ...
    }
}
