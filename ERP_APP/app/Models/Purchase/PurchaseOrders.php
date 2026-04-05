<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrders extends Model
{
    use HasFactory;
    protected $fillable = [
        'po_number',
        'supplier_id',
        'order_date',
        'expected_delivery',
        'warehouse',
        'payment_terms',
        'total_amount',
        'status',
        'approved_by',
        'order_items',
        'notes'
    ];
}
