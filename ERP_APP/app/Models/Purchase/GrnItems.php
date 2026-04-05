<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GrnItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'grn_id',
        'product_name',
        'sku',
        'quantity_ordered',
        'quantity_received',
        'unit_price',
        'total_value',
        'batch_number',
        'expiry_date',
        'notes'
    ];

    protected $casts = [
        'quantity_ordered' => 'decimal:2',
        'quantity_received' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_value' => 'decimal:2',
        'expiry_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function grn(): BelongsTo
    {
        return $this->belongsTo(Grn::class, 'grn_id');
    }

    public function getVarianceAttribute(): float
    {
        return $this->quantity_received - $this->quantity_ordered;
    }

    public function isOverReceived(): bool
    {
        return $this->quantity_received > $this->quantity_ordered;
    }

    public function isUnderReceived(): bool
    {
        return $this->quantity_received < $this->quantity_ordered;
    }

    public function getFormattedTotalValueAttribute(): string
    {
        return number_format($this->total_value, 2);
    }
}
