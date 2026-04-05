<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BatchTracking extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch_lot_number',
        'serial_number',
        'product_id',
        'quantity',
        'manufacturing_date',
        'expiry_date',
        'status',
        'warehouse_location',
        'cost_per_unit'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'manufacturing_date' => 'date',
        'expiry_date' => 'date',
        'cost_per_unit' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductCatalog::class);
    }

    public function isExpiringSoon(): bool
    {
        return $this->expiry_date && now()->diffInDays($this->expiry_date) <= 30;
    }

    public function isExpired(): bool
    {
        return $this->expiry_date && $this->expiry_date < now();
    }
}
