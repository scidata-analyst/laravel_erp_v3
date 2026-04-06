<?php

namespace App\Events\Sales;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomersEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        // TODO: Add event properties
    }
}
