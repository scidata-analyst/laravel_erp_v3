<?php

namespace App\Notifications\QualityControl;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class QcChecklistsNotification extends Notification
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
