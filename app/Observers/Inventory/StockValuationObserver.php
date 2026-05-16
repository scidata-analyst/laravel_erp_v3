<?php

namespace App\Observers\Inventory;

use App\Models\Inventory\StockValuation;

class StockValuationObserver
{
    /**
     * Handle the StockValuation "created" event.
     */
    public function created(StockValuation $stockValuation): void
    {
        //
    }

    /**
     * Handle the StockValuation "updated" event.
     */
    public function updated(StockValuation $stockValuation): void
    {
        //
    }

    /**
     * Handle the StockValuation "deleted" event.
     */
    public function deleted(StockValuation $stockValuation): void
    {
        //
    }

    /**
     * Handle the StockValuation "restored" event.
     */
    public function restored(StockValuation $stockValuation): void
    {
        //
    }

    /**
     * Handle the StockValuation "force deleted" event.
     */
    public function forceDeleted(StockValuation $stockValuation): void
    {
        //
    }
}
