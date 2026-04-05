<?php

namespace App\Events\HR;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PayrollEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}
