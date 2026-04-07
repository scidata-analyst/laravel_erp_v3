<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockValuation extends Model
{
    use HasFactory;
    protected $fillable = [
        'valuation_date',
        'product_id',
        'warehouse_id',
        'quantity_on_hand',
        'unit_cost',
        'total_value',
        'valuation_method',
        'notes'
    ];

    protected $casts = [
        'valuation_date' => 'date',
        'quantity_on_hand' => 'decimal:2',
        'unit_cost' => 'decimal:2',
        'total_value' => 'decimal:2',
    ];
}
