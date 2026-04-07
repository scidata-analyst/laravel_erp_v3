<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductCatalog extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'sku',
        'category',
        'unit_price',
        'cost_price',
        'warehouse',
        'reorder_level',
        'valuation_method',
        'description',
        'status',
        'barcode',
        'weight',
        'dimensions',
        'channel_id'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'weight' => 'decimal:2',
    ];
}
