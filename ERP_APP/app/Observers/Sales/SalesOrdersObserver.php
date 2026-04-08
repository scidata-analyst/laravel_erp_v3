<?php

namespace App\Observers\Sales;

use App\Models\Sales\SalesOrders;

class SalesOrdersObserver
{
    /**
     * Handle the SalesOrders "created" event.
     */
    public function created(SalesOrders $salesOrders): void
    {
        //
    }

    /**
     * Handle the SalesOrders "updated" event.
     */
    public function updated(SalesOrders $salesOrders): void
    {
        //
    }

    /**
     * Handle the SalesOrders "deleted" event.
     */
    public function deleted(SalesOrders $salesOrders): void
    {
        //
    }

    /**
     * Handle the SalesOrders "restored" event.
     */
    public function restored(SalesOrders $salesOrders): void
    {
        //
    }

    /**
     * Handle the SalesOrders "force deleted" event.
     */
    public function forceDeleted(SalesOrders $salesOrders): void
    {
        //
    }
}
