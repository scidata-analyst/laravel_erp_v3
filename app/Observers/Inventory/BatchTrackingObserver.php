<?php

namespace App\Observers\Inventory;

use App\Models\Inventory\BatchTracking;

class BatchTrackingObserver
{
    /**
     * Handle the BatchTracking "created" event.
     */
    public function created(BatchTracking $batchTracking): void
    {
        //
    }

    /**
     * Handle the BatchTracking "updated" event.
     */
    public function updated(BatchTracking $batchTracking): void
    {
        //
    }

    /**
     * Handle the BatchTracking "deleted" event.
     */
    public function deleted(BatchTracking $batchTracking): void
    {
        //
    }

    /**
     * Handle the BatchTracking "restored" event.
     */
    public function restored(BatchTracking $batchTracking): void
    {
        //
    }

    /**
     * Handle the BatchTracking "force deleted" event.
     */
    public function forceDeleted(BatchTracking $batchTracking): void
    {
        //
    }
}
