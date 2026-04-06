<?php

namespace App\Mail\QualityControl;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplianceMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array \ = [])
    {
    }

    public function build()
    {
        return \->subject('ComplianceMail');
    }
}
