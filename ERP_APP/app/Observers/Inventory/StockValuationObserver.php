<?php

namespace App\Observers\Inventory;

use App\Models\Inventory\StockValuation;

class StockValuationObserver
{
    /**
     * Handle the StockValuation "created" event.
     */
    public function created(StockValuation $modelVar): void
    {
        // ...
    }

    /**
     * Handle the StockValuation "updated" event.
     */
    public function updated(StockValuation $modelVar): void
    {
        // ...
    }

    /**
     * Handle the StockValuation "deleted" event.
     */
    public function deleted(StockValuation $modelVar): void
    {
        // ...
    }

    /**
     * Handle the StockValuation "restored" event.
     */
    public function restored(StockValuation $modelVar): void
    {
        // ...
    }

    /**
     * Handle the StockValuation "forceDeleted" event.
     */
    public function forceDeleted(StockValuation $modelVar): void
    {
        // ...
    }
}
