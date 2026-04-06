<?php

namespace App\Mail\Core;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SettingsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array \ = [])
    {
    }

    public function build()
    {
        return \->subject('SettingsMail');
    }
}
