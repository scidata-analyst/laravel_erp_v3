<?php

namespace App\Observers\Inventory;

use App\Models\Inventory\StockMovements;

class StockMovementsObserver
{
    /**
     * Handle the StockMovements "created" event.
     */
    public function created(StockMovements $modelVar): void
    {
        // ...
    }

    /**
     * Handle the StockMovements "updated" event.
     */
    public function updated(StockMovements $modelVar): void
    {
        // ...
    }

    /**
     * Handle the StockMovements "deleted" event.
     */
    public function deleted(StockMovements $modelVar): void
    {
        // ...
    }

    /**
     * Handle the StockMovements "restored" event.
     */
    public function restored(StockMovements $modelVar): void
    {
        // ...
    }

    /**
     * Handle the StockMovements "forceDeleted" event.
     */
    public function forceDeleted(StockMovements $modelVar): void
    {
        // ...
    }
}
