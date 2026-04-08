<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\InvSync;

class InvSyncObserver
{
    /**
     * Handle the InvSync "created" event.
     */
    public function created(InvSync $invSync): void
    {
        //
    }

    /**
     * Handle the InvSync "updated" event.
     */
    public function updated(InvSync $invSync): void
    {
        //
    }

    /**
     * Handle the InvSync "deleted" event.
     */
    public function deleted(InvSync $invSync): void
    {
        //
    }

    /**
     * Handle the InvSync "restored" event.
     */
    public function restored(InvSync $invSync): void
    {
        //
    }

    /**
     * Handle the InvSync "force deleted" event.
     */
    public function forceDeleted(InvSync $invSync): void
    {
        //
    }
}
