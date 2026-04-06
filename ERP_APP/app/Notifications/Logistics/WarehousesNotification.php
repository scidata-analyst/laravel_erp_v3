<?php

namespace App\Notifications\Logistics;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WarehousesNotification extends Notification
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
