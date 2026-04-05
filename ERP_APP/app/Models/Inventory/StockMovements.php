<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovements extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref_number',
        'date',
        'product_id',
        'movement_type',
        'quantity',
        'from_warehouse',
        'to_warehouse',
        'reason_notes',
        'user_id',
        'reason'
    ];

    protected $casts = [
        'date' => 'date',
        'quantity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductCatalog::class);
    }

    public function fromWarehouse(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Logistics\Warehouses::class, 'from_warehouse', 'code');
    }

    public function toWarehouse(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Logistics\Warehouses::class, 'to_warehouse', 'code');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function getReasonAttribute(): ?string
    {
        return $this->reason_notes;
    }

    public function setReasonAttribute(?string $value): void
    {
        $this->attributes['reason_notes'] = $value;
    }
}
