<?php

namespace App\Observers\Reports;

use App\Models\Reports\CustomReports;

class CustomReportsObserver
{
    /**
     * Handle the CustomReports "created" event.
     */
    public function created(CustomReports $customReports): void
    {
        //
    }

    /**
     * Handle the CustomReports "updated" event.
     */
    public function updated(CustomReports $customReports): void
    {
        //
    }

    /**
     * Handle the CustomReports "deleted" event.
     */
    public function deleted(CustomReports $customReports): void
    {
        //
    }

    /**
     * Handle the CustomReports "restored" event.
     */
    public function restored(CustomReports $customReports): void
    {
        //
    }

    /**
     * Handle the CustomReports "force deleted" event.
     */
    public function forceDeleted(CustomReports $customReports): void
    {
        //
    }
}
