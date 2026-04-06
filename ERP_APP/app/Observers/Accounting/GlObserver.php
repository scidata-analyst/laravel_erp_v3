<?php

namespace App\Observers\Accounting;

use App\Models\Accounting\Gl;

class GlObserver
{
    /**
     * Handle the Gl "created" event.
     */
    public function created(Gl $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Gl "updated" event.
     */
    public function updated(Gl $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Gl "deleted" event.
     */
    public function deleted(Gl $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Gl "restored" event.
     */
    public function restored(Gl $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Gl "forceDeleted" event.
     */
    public function forceDeleted(Gl $modelVar): void
    {
        // ...
    }
}
