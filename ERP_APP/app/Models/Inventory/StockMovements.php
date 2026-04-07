<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovements extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref_number',
        'date',
        'product_id',
        'movement_type',
        'quantity',
        'from_warehouse',
        'to_warehouse',
        'reason_notes',
        'user_id'
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
