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
        'api_endpoint',
        'api_key',
        'webhook_url',
        'sync_frequency',
        'last_sync_date',
        'status',
        'default_currency',
        'tax_inclusive',
        'shipping_methods',
        'payment_methods',
        'configuration'
    ];

    protected $casts = [
        'last_sync_date' => 'datetime',
        'tax_inclusive' => 'boolean',
        'shipping_methods' => 'json',
        'payment_methods' => 'json',
        'configuration' => 'json',
    ];
}
