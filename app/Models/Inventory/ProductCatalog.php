<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ProductCatalog
 *
 * Laravel Eloquent model for ProductCatalog table.
 */
class ProductCatalog extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'sku',
        'category',
        'unit_price',
        'cost_price',
        'warehouse_id',
        'reorder_level',
        'valuation_method',
        'description',
        'status',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the warehouse for this product.
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Logistics\Warehouses::class, 'warehouse_id');
    }

    /**
     * Get the batch tracking records for this product.
     */
    public function batchTrackings(): HasMany
    {
        return $this->hasMany(BatchTracking::class, 'product_id');
    }

    /**
     * Get the stock movements for this product.
     */
    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovements::class, 'product_id');
    }
}
