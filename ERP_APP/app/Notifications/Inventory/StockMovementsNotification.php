<?php

namespace App\Notifications\Inventory;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StockMovementsNotification extends Notification
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
