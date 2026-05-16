<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Pos;

class PosObserver
{
    /**
     * Handle the Pos "created" event.
     */
    public function created(Pos $pos): void
    {
        //
    }

    /**
     * Handle the Pos "updated" event.
     */
    public function updated(Pos $pos): void
    {
        //
    }

    /**
     * Handle the Pos "deleted" event.
     */
    public function deleted(Pos $pos): void
    {
        //
    }

    /**
     * Handle the Pos "restored" event.
     */
    public function restored(Pos $pos): void
    {
        //
    }

    /**
     * Handle the Pos "force deleted" event.
     */
    public function forceDeleted(Pos $pos): void
    {
        //
    }
}
