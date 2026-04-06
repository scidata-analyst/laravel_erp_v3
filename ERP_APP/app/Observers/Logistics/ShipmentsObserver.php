<?php

namespace App\Observers\Logistics;

use App\Models\Logistics\Shipments;

class ShipmentsObserver
{
    /**
     * Handle the Shipments "created" event.
     */
    public function created(Shipments $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Shipments "updated" event.
     */
    public function updated(Shipments $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Shipments "deleted" event.
     */
    public function deleted(Shipments $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Shipments "restored" event.
     */
    public function restored(Shipments $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Shipments "forceDeleted" event.
     */
    public function forceDeleted(Shipments $modelVar): void
    {
        // ...
    }
}
