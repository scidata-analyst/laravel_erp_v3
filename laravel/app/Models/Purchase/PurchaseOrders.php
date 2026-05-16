<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PurchaseOrders
 *
 * Laravel Eloquent model for PurchaseOrders table.
 */
class PurchaseOrders extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchase_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_id',
        'po_number',
        'order_date',
        'expected_delivery_date',
        'warehouse_id',
        'payment_terms',
        'total_amount',
        'status',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the supplier for this purchase order.
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    /**
     * Get the warehouse for this purchase order.
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Logistics\Warehouses::class, 'warehouse_id');
    }
}
