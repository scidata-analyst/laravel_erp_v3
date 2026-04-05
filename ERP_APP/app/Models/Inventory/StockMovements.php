<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovements extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_number',
        'date',
        'product',
        'type',
        'quantity',
        'warehouse',
        'reason',
        'user',
        'movement_type',
        'from_warehouse',
        'to_warehouse'
    ];
}
