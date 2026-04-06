<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\OnlineChannels;

class OnlineChannelsObserver
{
    /**
     * Handle the OnlineChannels "created" event.
     */
    public function created(OnlineChannels $modelVar): void
    {
        // ...
    }

    /**
     * Handle the OnlineChannels "updated" event.
     */
    public function updated(OnlineChannels $modelVar): void
    {
        // ...
    }

    /**
     * Handle the OnlineChannels "deleted" event.
     */
    public function deleted(OnlineChannels $modelVar): void
    {
        // ...
    }

    /**
     * Handle the OnlineChannels "restored" event.
     */
    public function restored(OnlineChannels $modelVar): void
    {
        // ...
    }

    /**
     * Handle the OnlineChannels "forceDeleted" event.
     */
    public function forceDeleted(OnlineChannels $modelVar): void
    {
        // ...
    }
}
