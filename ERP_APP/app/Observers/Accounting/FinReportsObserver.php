<?php

namespace App\Observers\Accounting;

use App\Models\Accounting\FinReports;

class FinReportsObserver
{
    /**
     * Handle the FinReports "created" event.
     */
    public function created(FinReports $modelVar): void
    {
        // ...
    }

    /**
     * Handle the FinReports "updated" event.
     */
    public function updated(FinReports $modelVar): void
    {
        // ...
    }

    /**
     * Handle the FinReports "deleted" event.
     */
    public function deleted(FinReports $modelVar): void
    {
        // ...
    }

    /**
     * Handle the FinReports "restored" event.
     */
    public function restored(FinReports $modelVar): void
    {
        // ...
    }

    /**
     * Handle the FinReports "forceDeleted" event.
     */
    public function forceDeleted(FinReports $modelVar): void
    {
        // ...
    }
}
