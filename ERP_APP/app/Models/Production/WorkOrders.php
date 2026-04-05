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
        'product',
        'bom',
        'quantity',
        'start_date',
        'end_date',
        'status',
        'assigned_to',
        'priority',
    ];
}
