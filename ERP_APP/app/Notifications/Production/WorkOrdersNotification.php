<?php

namespace App\Notifications\Production;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WorkOrdersNotification extends Notification
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
