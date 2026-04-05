<?php

namespace App\Events\Production;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BomEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}
