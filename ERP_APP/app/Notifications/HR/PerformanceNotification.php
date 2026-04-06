<?php

namespace App\Notifications\HR;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PerformanceNotification extends Notification
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
