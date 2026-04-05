<?php

namespace App\Events\CRM;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InteractionsEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}
