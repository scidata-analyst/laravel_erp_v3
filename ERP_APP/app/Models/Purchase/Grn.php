<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grn extends Model
{
    use HasFactory;
    protected $fillable = [
        'grn_number',
        'purchase_order_id',
        'supplier_id',
        'received_date',
        'total_items',
        'total_quantity',
        'status',
        'notes',
        'received_by'
    ];

    protected $casts = [
        'received_date' => 'date',
    ];
}
