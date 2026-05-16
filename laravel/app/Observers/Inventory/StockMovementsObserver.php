<?php

namespace App\Observers\Inventory;

use App\Models\Inventory\StockMovements;

class StockMovementsObserver
{
    /**
     * Handle the StockMovements "created" event.
     */
    public function created(StockMovements $stockMovements): void
    {
        //
    }

    /**
     * Handle the StockMovements "updated" event.
     */
    public function updated(StockMovements $stockMovements): void
    {
        //
    }

    /**
     * Handle the StockMovements "deleted" event.
     */
    public function deleted(StockMovements $stockMovements): void
    {
        //
    }

    /**
     * Handle the StockMovements "restored" event.
     */
    public function restored(StockMovements $stockMovements): void
    {
        //
    }

    /**
     * Handle the StockMovements "force deleted" event.
     */
    public function forceDeleted(StockMovements $stockMovements): void
    {
        //
    }
}
