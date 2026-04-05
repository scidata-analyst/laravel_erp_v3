<?php

namespace App\Events\Logistics;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShipmentsEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}
