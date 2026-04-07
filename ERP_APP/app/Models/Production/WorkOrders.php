<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkOrders extends Model
{
    use HasFactory;
    protected $fillable = [
        'wo_number',
        'product_bom_id',
        'qty_to_produce',
        'priority',
        'start_date',
        'end_date',
        'assigned_to',
        'status',
        'actual_qty_produced',
        'scrap_quantity',
        'notes'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
