<?php

namespace App\Listeners\Ecommerce;

use App\Events\Ecommerce\OnlineChannelsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OnlineChannelsListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OnlineChannelsEvent $event): void
    {
        //
    }
}
