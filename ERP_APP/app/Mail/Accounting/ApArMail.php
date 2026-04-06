<?php

namespace App\Mail\Accounting;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApArMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $data = [])
    {
    }

    public function build()
    {
        return $this->data->subject('ApArMail');
    }
}
