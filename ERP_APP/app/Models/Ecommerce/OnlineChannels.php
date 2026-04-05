<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OnlineChannels extends Model
{
    use HasFactory;
    protected $fillable = [
        'channel_name',
        'platform',
        'orders',
        'revenue',
        'sync_status',
        'last_sync_date',
        'status',
        'api_url',
        'api_key',
        'sync_frequency',
    ];
}
