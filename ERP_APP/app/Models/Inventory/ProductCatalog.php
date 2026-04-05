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
        'dimensions'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'reorder_level' => 'integer',
        'weight' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovements::class);
    }

    public function batchTracking(): HasMany
    {
        return $this->hasMany(BatchTracking::class);
    }

    public function warehouseLocation(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Logistics\Warehouses::class, 'warehouse', 'code');
    }
}
