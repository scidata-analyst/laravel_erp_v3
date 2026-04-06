<?php

namespace App\Notifications\Projects;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProjectCostNotification extends Notification
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
