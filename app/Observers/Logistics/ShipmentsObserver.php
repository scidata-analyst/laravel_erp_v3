<?php

namespace App\Observers\Logistics;

use App\Models\Logistics\Shipments;

class ShipmentsObserver
{
    /**
     * Handle the Shipments "created" event.
     */
    public function created(Shipments $shipments): void
    {
        //
    }

    /**
     * Handle the Shipments "updated" event.
     */
    public function updated(Shipments $shipments): void
    {
        //
    }

    /**
     * Handle the Shipments "deleted" event.
     */
    public function deleted(Shipments $shipments): void
    {
        //
    }

    /**
     * Handle the Shipments "restored" event.
     */
    public function restored(Shipments $shipments): void
    {
        //
    }

    /**
     * Handle the Shipments "force deleted" event.
     */
    public function forceDeleted(Shipments $shipments): void
    {
        //
    }
}
