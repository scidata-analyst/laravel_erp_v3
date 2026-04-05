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
        'promotion_code',
        'description',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'status',
        'min_order',
        'applicable_products',
    ];
}
