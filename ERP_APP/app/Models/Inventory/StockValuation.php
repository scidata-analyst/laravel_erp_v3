<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class StockValuation
 *
 * Laravel Eloquent model for StockValuation table.
 */
class StockValuation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stock_valuation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'valuation_method',
        'unit_cost',
        'quantity_on_hand',
        'total_value',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the product for this stock valuation.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductCatalog::class, 'product_id');
    }
}
