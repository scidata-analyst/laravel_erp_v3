<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupplierPayments extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_number',
        'supplier_id',
        'purchase_order_id',
        'payment_date',
        'amount',
        'payment_method',
        'reference',
        'status',
        'notes',
    ];
}
