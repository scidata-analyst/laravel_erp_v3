<?php

namespace App\Models\Logistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Shipments
 *
 * Laravel Eloquent model for Shipments table.
 */
class Shipments extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shipments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sales_order_id',
        'carrier',
        'tracking_number',
        'estimated_delivery_date',
        'shipping_address',
        'status',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the sales order for this shipment.
     */
    public function salesOrder(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Sales\SalesOrders::class, 'sales_order_id');
    }
}
