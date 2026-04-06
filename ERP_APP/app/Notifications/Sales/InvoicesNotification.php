<?php

namespace App\Notifications\Sales;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class InvoicesNotification extends Notification
{
    use Queueable;

    public function via(object \): array
    {
        return ['mail', 'database'];
    }

    public function toArray(object \): array
    {
        return [];
    }
}
