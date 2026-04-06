<?php

namespace App\Notifications\Reports;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CustomReportsNotification extends Notification
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
