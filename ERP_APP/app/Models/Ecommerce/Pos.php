<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pos extends Model
{
    use HasFactory;
    protected $fillable = [
        'terminal_name',
        'location',
        'store_code',
        'device_id',
        'cash_drawer_balance',
        'session_status',
        'current_user_id',
        'last_sync_date',
        'offline_mode',
        'configuration',
        'status'
    ];

    protected $casts = [
        'cash_drawer_balance' => 'decimal:2',
        'last_sync_date' => 'datetime',
        'offline_mode' => 'boolean',
        'configuration' => 'json',
    ];
}
