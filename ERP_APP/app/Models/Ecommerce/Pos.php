<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pos extends Model
{
    use HasFactory;
    protected $fillable = [
        'terminal_id',
        'location',
        'cashier',
        'session_start',
        'sales',
        'transactions',
        'status',
        'receipt_printer',
        'warehouse_id',
    ];
}
