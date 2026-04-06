<?php

namespace App\Events\Ecommerce;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OnlineChannelsEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        // TODO: Add event properties
    }
}
