<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvSync extends Model
{
    use HasFactory;
    protected $fillable = [
        'sync_reference',
        'terminal_id',
        'channel_id',
        'sync_type',
        'product_sku',
        'online_quantity',
        'local_quantity',
        'variance',
        'sync_date',
        'status',
        'error_message',
        'retry_count'
    ];

    protected $casts = [
        'online_quantity' => 'decimal:2',
        'local_quantity' => 'decimal:2',
        'variance' => 'decimal:2',
        'sync_date' => 'datetime',
    ];
}
