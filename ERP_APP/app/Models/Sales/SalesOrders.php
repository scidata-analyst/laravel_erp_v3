<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesOrders extends Model
{
    use HasFactory;
    protected $fillable = [
        'so_number',
        'customer_id',
        'order_date',
        'delivery_date',
        'payment_terms',
        'discount',
        'total_amount',
        'status',
        'order_items',
        'notes',
        'discount_id',
        'promotion_id',
        'channel_id',
        'tax_id'
    ];

    protected $casts = [
        'order_date' => 'date',
        'delivery_date' => 'date',
        'discount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'order_items' => 'json',
    ];
}
