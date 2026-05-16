<?php

namespace App\Observers\Reports;

use App\Models\Reports\BiDashboards;

class BiDashboardsObserver
{
    /**
     * Handle the BiDashboards "created" event.
     */
    public function created(BiDashboards $biDashboards): void
    {
        //
    }

    /**
     * Handle the BiDashboards "updated" event.
     */
    public function updated(BiDashboards $biDashboards): void
    {
        //
    }

    /**
     * Handle the BiDashboards "deleted" event.
     */
    public function deleted(BiDashboards $biDashboards): void
    {
        //
    }

    /**
     * Handle the BiDashboards "restored" event.
     */
    public function restored(BiDashboards $biDashboards): void
    {
        //
    }

    /**
     * Handle the BiDashboards "force deleted" event.
     */
    public function forceDeleted(BiDashboards $biDashboards): void
    {
        //
    }
}
