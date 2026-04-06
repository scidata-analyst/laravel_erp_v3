<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\Pos;

class PosObserver
{
    /**
     * Handle the Pos "created" event.
     */
    public function created(Pos $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Pos "updated" event.
     */
    public function updated(Pos $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Pos "deleted" event.
     */
    public function deleted(Pos $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Pos "restored" event.
     */
    public function restored(Pos $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Pos "forceDeleted" event.
     */
    public function forceDeleted(Pos $modelVar): void
    {
        // ...
    }
}
