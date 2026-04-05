<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockValuation extends Model
{
    use HasFactory;
    protected $fillable = [
        'product',
        'sku',
        'quantity',
        'cost_method',
        'unit_cost',
        'total_value',
        'last_updated_at'
    ];
}
