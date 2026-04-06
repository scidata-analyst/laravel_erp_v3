<?php

namespace App\Observers\Production;

use App\Models\Production\Bom;

class BomObserver
{
    /**
     * Handle the Bom "created" event.
     */
    public function created(Bom $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Bom "updated" event.
     */
    public function updated(Bom $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Bom "deleted" event.
     */
    public function deleted(Bom $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Bom "restored" event.
     */
    public function restored(Bom $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Bom "forceDeleted" event.
     */
    public function forceDeleted(Bom $modelVar): void
    {
        // ...
    }
}
