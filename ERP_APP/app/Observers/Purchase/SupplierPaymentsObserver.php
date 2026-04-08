<?php

namespace App\Observers\Purchase;

use App\Models\Purchase\SupplierPayments;

class SupplierPaymentsObserver
{
    /**
     * Handle the SupplierPayments "created" event.
     */
    public function created(SupplierPayments $supplierPayments): void
    {
        //
    }

    /**
     * Handle the SupplierPayments "updated" event.
     */
    public function updated(SupplierPayments $supplierPayments): void
    {
        //
    }

    /**
     * Handle the SupplierPayments "deleted" event.
     */
    public function deleted(SupplierPayments $supplierPayments): void
    {
        //
    }

    /**
     * Handle the SupplierPayments "restored" event.
     */
    public function restored(SupplierPayments $supplierPayments): void
    {
        //
    }

    /**
     * Handle the SupplierPayments "force deleted" event.
     */
    public function forceDeleted(SupplierPayments $supplierPayments): void
    {
        //
    }
}
