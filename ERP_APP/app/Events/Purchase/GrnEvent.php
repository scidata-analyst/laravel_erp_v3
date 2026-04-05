<?php

namespace App\Events\Purchase;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GrnEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}
