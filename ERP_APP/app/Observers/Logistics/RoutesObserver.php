<?php

namespace App\Observers\Logistics;

use App\Models\Logistics\Routes;

class RoutesObserver
{
    /**
     * Handle the Routes "created" event.
     */
    public function created(Routes $routes): void
    {
        //
    }

    /**
     * Handle the Routes "updated" event.
     */
    public function updated(Routes $routes): void
    {
        //
    }

    /**
     * Handle the Routes "deleted" event.
     */
    public function deleted(Routes $routes): void
    {
        //
    }

    /**
     * Handle the Routes "restored" event.
     */
    public function restored(Routes $routes): void
    {
        //
    }

    /**
     * Handle the Routes "force deleted" event.
     */
    public function forceDeleted(Routes $routes): void
    {
        //
    }
}
