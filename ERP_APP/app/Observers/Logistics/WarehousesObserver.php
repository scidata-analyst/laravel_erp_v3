<?php

namespace App\Observers\Logistics;

use App\Models\Logistics\Warehouses;

class WarehousesObserver
{
    /**
     * Handle the Warehouses "created" event.
     */
    public function created(Warehouses $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Warehouses "updated" event.
     */
    public function updated(Warehouses $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Warehouses "deleted" event.
     */
    public function deleted(Warehouses $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Warehouses "restored" event.
     */
    public function restored(Warehouses $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Warehouses "forceDeleted" event.
     */
    public function forceDeleted(Warehouses $modelVar): void
    {
        // ...
    }
}
