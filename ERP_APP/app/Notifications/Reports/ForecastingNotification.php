<?php

namespace App\Notifications\Reports;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ForecastingNotification extends Notification
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
