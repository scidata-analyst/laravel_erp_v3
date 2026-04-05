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
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductCatalog::class, 'product_id');
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Logistics\Warehouses::class, 'warehouse_id');
    }

    public function isFifo(): bool
    {
        return $this->valuation_method === 'FIFO';
    }

    public function isLifo(): bool
    {
        return $this->valuation_method === 'LIFO';
    }

    public function isWeightedAverage(): bool
    {
        return $this->valuation_method === 'Weighted Average';
    }

    public function getFormattedTotalValueAttribute(): string
    {
        return '$' . number_format($this->total_value, 2);
    }

    public function getFormattedUnitCostAttribute(): string
    {
        return '$' . number_format($this->unit_cost, 2);
    }

    public function getTurnoverRatioAttribute(): float
    {
        // This would be calculated based on sales vs stock value
        return 0.0; // Placeholder
    }
}
