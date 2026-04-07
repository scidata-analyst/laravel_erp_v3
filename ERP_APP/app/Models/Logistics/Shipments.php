<?php

namespace App\Models\Logistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipments extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_number',
        'sales_order_id',
        'customer',
        'carrier',
        'tracking_number',
        'est_delivery_date',
        'actual_delivery_date',
        'status',
        'shipping_address',
        'cost',
        'notes',
        'route_id'
    ];

    protected $casts = [
        'est_delivery_date' => 'date',
        'actual_delivery_date' => 'date',
        'cost' => 'decimal:2',
    ];
}
