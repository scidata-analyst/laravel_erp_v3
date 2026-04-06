<?php

namespace App\Observers\Sales;

use App\Models\Sales\SalesOrders;

class SalesOrdersObserver
{
    /**
     * Handle the SalesOrders "created" event.
     */
    public function created(SalesOrders $modelVar): void
    {
        // ...
    }

    /**
     * Handle the SalesOrders "updated" event.
     */
    public function updated(SalesOrders $modelVar): void
    {
        // ...
    }

    /**
     * Handle the SalesOrders "deleted" event.
     */
    public function deleted(SalesOrders $modelVar): void
    {
        // ...
    }

    /**
     * Handle the SalesOrders "restored" event.
     */
    public function restored(SalesOrders $modelVar): void
    {
        // ...
    }

    /**
     * Handle the SalesOrders "forceDeleted" event.
     */
    public function forceDeleted(SalesOrders $modelVar): void
    {
        // ...
    }
}
