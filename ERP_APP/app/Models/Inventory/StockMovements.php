<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class StockMovements
 *
 * Laravel Eloquent model for StockMovements table.
 */
class StockMovements extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stock_movements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'movement_type',
        'quantity',
        'from_warehouse_id',
        'to_warehouse_id',
        'reason',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the product for this stock movement.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductCatalog::class, 'product_id');
    }

    /**
     * Get the source warehouse for this stock movement.
     */
    public function fromWarehouse(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Logistics\Warehouses::class, 'from_warehouse_id');
    }

    /**
     * Get the destination warehouse for this stock movement.
     */
    public function toWarehouse(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Logistics\Warehouses::class, 'to_warehouse_id');
    }
}
