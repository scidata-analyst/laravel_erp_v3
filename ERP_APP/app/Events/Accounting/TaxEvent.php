<?php

namespace App\Events\Accounting;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaxEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        // TODO: Add event properties
    }
}
