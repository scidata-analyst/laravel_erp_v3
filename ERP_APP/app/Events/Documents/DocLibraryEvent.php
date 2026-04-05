<?php

namespace App\Events\Documents;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DocLibraryEvent
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
        //
    }
}
