<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BatchTracking extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch_number',
        'serial',
        'product',
        'quantity',
        'manufacturing_date',
        'expiry_date',
        'status',
    ];
}
