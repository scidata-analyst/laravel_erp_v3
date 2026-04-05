<?php

namespace App\Models\Logistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipments extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment',
        'sales_order',
        'customer',
        'currier',
        'tracking_number',
        'estimated_delivery',
        'status',
        'shipping_address',
    ];
}
