<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BatchTracking extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch_lot_number',
        'serial_number',
        'product_id',
        'quantity',
        'manufacturing_date',
        'expiry_date',
        'status',
        'warehouse_location',
        'cost_per_unit'
    ];

    protected $casts = [
        'manufacturing_date' => 'date',
        'expiry_date' => 'date',
        'cost_per_unit' => 'decimal:2',
    ];
}
