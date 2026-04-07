<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promotions extends Model
{
    use HasFactory;
    protected $fillable = [
        'promotion_name',
        'discount_id',
        'start_date',
        'end_date',
        'applicable_products',
        'minimum_purchase',
        'usage_limit',
        'used_count',
        'status',
        'description',
        'created_by'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'applicable_products' => 'json',
        'minimum_purchase' => 'decimal:2',
    ];
}
