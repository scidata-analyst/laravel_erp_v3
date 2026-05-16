<?php

namespace App\Observers\Purchase;

use App\Models\Purchase\PurchaseOrders;

class PurchaseOrdersObserver
{
    /**
     * Handle the PurchaseOrders "created" event.
     */
    public function created(PurchaseOrders $purchaseOrders): void
    {
        //
    }

    /**
     * Handle the PurchaseOrders "updated" event.
     */
    public function updated(PurchaseOrders $purchaseOrders): void
    {
        //
    }

    /**
     * Handle the PurchaseOrders "deleted" event.
     */
    public function deleted(PurchaseOrders $purchaseOrders): void
    {
        //
    }

    /**
     * Handle the PurchaseOrders "restored" event.
     */
    public function restored(PurchaseOrders $purchaseOrders): void
    {
        //
    }

    /**
     * Handle the PurchaseOrders "force deleted" event.
     */
    public function forceDeleted(PurchaseOrders $purchaseOrders): void
    {
        //
    }
}
