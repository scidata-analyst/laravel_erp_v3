<?php

namespace App\Observers\Reports;

use App\Models\Reports\CustomReports;

class CustomReportsObserver
{
    /**
     * Handle the CustomReports "created" event.
     */
    public function created(CustomReports $modelVar): void
    {
        // ...
    }

    /**
     * Handle the CustomReports "updated" event.
     */
    public function updated(CustomReports $modelVar): void
    {
        // ...
    }

    /**
     * Handle the CustomReports "deleted" event.
     */
    public function deleted(CustomReports $modelVar): void
    {
        // ...
    }

    /**
     * Handle the CustomReports "restored" event.
     */
    public function restored(CustomReports $modelVar): void
    {
        // ...
    }

    /**
     * Handle the CustomReports "forceDeleted" event.
     */
    public function forceDeleted(CustomReports $modelVar): void
    {
        // ...
    }
}
