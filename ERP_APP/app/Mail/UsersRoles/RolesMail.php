<?php

namespace App\Mail\UsersRoles;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RolesMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array \ = [])
    {
    }

    public function build()
    {
        return \->subject('RolesMail');
    }
}
