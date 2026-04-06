<?php

namespace App\Notifications\Accounting;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ApArNotification extends Notification
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
