<?php

namespace App\Observers\Inventory;

use App\Models\Inventory\BatchTracking;

class BatchTrackingObserver
{
    /**
     * Handle the BatchTracking "created" event.
     */
    public function created(BatchTracking $modelVar): void
    {
        // ...
    }

    /**
     * Handle the BatchTracking "updated" event.
     */
    public function updated(BatchTracking $modelVar): void
    {
        // ...
    }

    /**
     * Handle the BatchTracking "deleted" event.
     */
    public function deleted(BatchTracking $modelVar): void
    {
        // ...
    }

    /**
     * Handle the BatchTracking "restored" event.
     */
    public function restored(BatchTracking $modelVar): void
    {
        // ...
    }

    /**
     * Handle the BatchTracking "forceDeleted" event.
     */
    public function forceDeleted(BatchTracking $modelVar): void
    {
        // ...
    }
}
