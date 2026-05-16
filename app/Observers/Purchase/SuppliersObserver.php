<?php

namespace App\Observers\Purchase;

use App\Models\Purchase\Suppliers;

class SuppliersObserver
{
    /**
     * Handle the Suppliers "created" event.
     */
    public function created(Suppliers $suppliers): void
    {
        //
    }

    /**
     * Handle the Suppliers "updated" event.
     */
    public function updated(Suppliers $suppliers): void
    {
        //
    }

    /**
     * Handle the Suppliers "deleted" event.
     */
    public function deleted(Suppliers $suppliers): void
    {
        //
    }

    /**
     * Handle the Suppliers "restored" event.
     */
    public function restored(Suppliers $suppliers): void
    {
        //
    }

    /**
     * Handle the Suppliers "force deleted" event.
     */
    public function forceDeleted(Suppliers $suppliers): void
    {
        //
    }
}
