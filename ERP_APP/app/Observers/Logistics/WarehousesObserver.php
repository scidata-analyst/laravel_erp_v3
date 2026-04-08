<?php

namespace App\Observers\Logistics;

use App\Models\Logistics\Warehouses;

class WarehousesObserver
{
    /**
     * Handle the Warehouses "created" event.
     */
    public function created(Warehouses $warehouses): void
    {
        //
    }

    /**
     * Handle the Warehouses "updated" event.
     */
    public function updated(Warehouses $warehouses): void
    {
        //
    }

    /**
     * Handle the Warehouses "deleted" event.
     */
    public function deleted(Warehouses $warehouses): void
    {
        //
    }

    /**
     * Handle the Warehouses "restored" event.
     */
    public function restored(Warehouses $warehouses): void
    {
        //
    }

    /**
     * Handle the Warehouses "force deleted" event.
     */
    public function forceDeleted(Warehouses $warehouses): void
    {
        //
    }
}
