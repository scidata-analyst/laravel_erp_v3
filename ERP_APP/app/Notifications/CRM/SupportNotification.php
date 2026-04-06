<?php

namespace App\Notifications\CRM;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SupportNotification extends Notification
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
