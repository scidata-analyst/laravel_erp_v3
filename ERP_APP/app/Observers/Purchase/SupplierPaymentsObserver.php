<?php

namespace App\Observers\Purchase;

use App\Models\Purchase\SupplierPayments;

class SupplierPaymentsObserver
{
    /**
     * Handle the SupplierPayments "created" event.
     */
    public function created(SupplierPayments $modelVar): void
    {
        // ...
    }

    /**
     * Handle the SupplierPayments "updated" event.
     */
    public function updated(SupplierPayments $modelVar): void
    {
        // ...
    }

    /**
     * Handle the SupplierPayments "deleted" event.
     */
    public function deleted(SupplierPayments $modelVar): void
    {
        // ...
    }

    /**
     * Handle the SupplierPayments "restored" event.
     */
    public function restored(SupplierPayments $modelVar): void
    {
        // ...
    }

    /**
     * Handle the SupplierPayments "forceDeleted" event.
     */
    public function forceDeleted(SupplierPayments $modelVar): void
    {
        // ...
    }
}
