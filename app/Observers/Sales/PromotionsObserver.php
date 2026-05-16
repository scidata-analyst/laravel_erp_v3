<?php

namespace App\Observers\Sales;

use App\Models\Sales\Promotions;

class PromotionsObserver
{
    /**
     * Handle the Promotions "created" event.
     */
    public function created(Promotions $promotions): void
    {
        //
    }

    /**
     * Handle the Promotions "updated" event.
     */
    public function updated(Promotions $promotions): void
    {
        //
    }

    /**
     * Handle the Promotions "deleted" event.
     */
    public function deleted(Promotions $promotions): void
    {
        //
    }

    /**
     * Handle the Promotions "restored" event.
     */
    public function restored(Promotions $promotions): void
    {
        //
    }

    /**
     * Handle the Promotions "force deleted" event.
     */
    public function forceDeleted(Promotions $promotions): void
    {
        //
    }
}
