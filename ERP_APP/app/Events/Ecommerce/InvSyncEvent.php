<?php

namespace App\Events\Ecommerce;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InvSyncEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}
