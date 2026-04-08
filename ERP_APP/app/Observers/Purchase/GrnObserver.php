<?php

namespace App\Observers\Purchase;

use App\Models\Purchase\Grn;

class GrnObserver
{
    /**
     * Handle the Grn "created" event.
     */
    public function created(Grn $grn): void
    {
        //
    }

    /**
     * Handle the Grn "updated" event.
     */
    public function updated(Grn $grn): void
    {
        //
    }

    /**
     * Handle the Grn "deleted" event.
     */
    public function deleted(Grn $grn): void
    {
        //
    }

    /**
     * Handle the Grn "restored" event.
     */
    public function restored(Grn $grn): void
    {
        //
    }

    /**
     * Handle the Grn "force deleted" event.
     */
    public function forceDeleted(Grn $grn): void
    {
        //
    }
}
