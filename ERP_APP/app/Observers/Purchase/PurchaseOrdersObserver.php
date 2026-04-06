<?php

namespace App\Observers\Purchase;

use App\Models\Purchase\PurchaseOrders;

class PurchaseOrdersObserver
{
    /**
     * Handle the PurchaseOrders "created" event.
     */
    public function created(PurchaseOrders $modelVar): void
    {
        // ...
    }

    /**
     * Handle the PurchaseOrders "updated" event.
     */
    public function updated(PurchaseOrders $modelVar): void
    {
        // ...
    }

    /**
     * Handle the PurchaseOrders "deleted" event.
     */
    public function deleted(PurchaseOrders $modelVar): void
    {
        // ...
    }

    /**
     * Handle the PurchaseOrders "restored" event.
     */
    public function restored(PurchaseOrders $modelVar): void
    {
        // ...
    }

    /**
     * Handle the PurchaseOrders "forceDeleted" event.
     */
    public function forceDeleted(PurchaseOrders $modelVar): void
    {
        // ...
    }
}
