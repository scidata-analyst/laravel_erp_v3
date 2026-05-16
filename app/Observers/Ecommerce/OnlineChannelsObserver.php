<?php

namespace App\Observers\Ecommerce;

use App\Models\Ecommerce\OnlineChannels;

class OnlineChannelsObserver
{
    /**
     * Handle the OnlineChannels "created" event.
     */
    public function created(OnlineChannels $onlineChannels): void
    {
        //
    }

    /**
     * Handle the OnlineChannels "updated" event.
     */
    public function updated(OnlineChannels $onlineChannels): void
    {
        //
    }

    /**
     * Handle the OnlineChannels "deleted" event.
     */
    public function deleted(OnlineChannels $onlineChannels): void
    {
        //
    }

    /**
     * Handle the OnlineChannels "restored" event.
     */
    public function restored(OnlineChannels $onlineChannels): void
    {
        //
    }

    /**
     * Handle the OnlineChannels "force deleted" event.
     */
    public function forceDeleted(OnlineChannels $onlineChannels): void
    {
        //
    }
}
