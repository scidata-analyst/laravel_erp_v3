<?php

namespace App\Observers\Purchase;

use App\Models\Purchase\Grn;

class GrnObserver
{
    /**
     * Handle the Grn "created" event.
     */
    public function created(Grn $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Grn "updated" event.
     */
    public function updated(Grn $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Grn "deleted" event.
     */
    public function deleted(Grn $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Grn "restored" event.
     */
    public function restored(Grn $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Grn "forceDeleted" event.
     */
    public function forceDeleted(Grn $modelVar): void
    {
        // ...
    }
}
