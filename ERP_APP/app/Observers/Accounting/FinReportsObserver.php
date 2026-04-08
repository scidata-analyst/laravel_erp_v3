<?php

namespace App\Observers\Accounting;

use App\Models\Accounting\FinReports;

class FinReportsObserver
{
    /**
     * Handle the FinReports "created" event.
     */
    public function created(FinReports $finReports): void
    {
        //
    }

    /**
     * Handle the FinReports "updated" event.
     */
    public function updated(FinReports $finReports): void
    {
        //
    }

    /**
     * Handle the FinReports "deleted" event.
     */
    public function deleted(FinReports $finReports): void
    {
        //
    }

    /**
     * Handle the FinReports "restored" event.
     */
    public function restored(FinReports $finReports): void
    {
        //
    }

    /**
     * Handle the FinReports "force deleted" event.
     */
    public function forceDeleted(FinReports $finReports): void
    {
        //
    }
}
