<?php

namespace App\Observers\Sales;

use App\Models\Sales\Promotions;

class PromotionsObserver
{
    /**
     * Handle the Promotions "created" event.
     */
    public function created(Promotions $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Promotions "updated" event.
     */
    public function updated(Promotions $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Promotions "deleted" event.
     */
    public function deleted(Promotions $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Promotions "restored" event.
     */
    public function restored(Promotions $modelVar): void
    {
        // ...
    }

    /**
     * Handle the Promotions "forceDeleted" event.
     */
    public function forceDeleted(Promotions $modelVar): void
    {
        // ...
    }
}
