<?php

namespace App\Mail\Logistics;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShipmentsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array \ = [])
    {
    }

    public function build()
    {
        return \->subject('ShipmentsMail');
    }
}
