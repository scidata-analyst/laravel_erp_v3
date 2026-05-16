<?php

namespace App\Observers\Production;

use App\Models\Production\Bom;

class BomObserver
{
    /**
     * Handle the Bom "created" event.
     */
    public function created(Bom $bom): void
    {
        //
    }

    /**
     * Handle the Bom "updated" event.
     */
    public function updated(Bom $bom): void
    {
        //
    }

    /**
     * Handle the Bom "deleted" event.
     */
    public function deleted(Bom $bom): void
    {
        //
    }

    /**
     * Handle the Bom "restored" event.
     */
    public function restored(Bom $bom): void
    {
        //
    }

    /**
     * Handle the Bom "force deleted" event.
     */
    public function forceDeleted(Bom $bom): void
    {
        //
    }
}
