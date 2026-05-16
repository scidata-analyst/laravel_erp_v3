<?php

namespace App\Observers\Accounting;

use App\Models\Accounting\Gl;

class GlObserver
{
    /**
     * Handle the Gl "created" event.
     */
    public function created(Gl $gl): void
    {
        //
    }

    /**
     * Handle the Gl "updated" event.
     */
    public function updated(Gl $gl): void
    {
        //
    }

    /**
     * Handle the Gl "deleted" event.
     */
    public function deleted(Gl $gl): void
    {
        //
    }

    /**
     * Handle the Gl "restored" event.
     */
    public function restored(Gl $gl): void
    {
        //
    }

    /**
     * Handle the Gl "force deleted" event.
     */
    public function forceDeleted(Gl $gl): void
    {
        //
    }
}
