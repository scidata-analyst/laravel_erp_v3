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
        'notes'
    ];
}
