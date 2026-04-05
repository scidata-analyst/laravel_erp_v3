<?php

namespace App\Events\Accounting;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ApArEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}
