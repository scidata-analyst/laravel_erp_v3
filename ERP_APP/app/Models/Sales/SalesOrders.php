<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SalesOrders extends Model
{
    use HasFactory;
    protected $fillable = [
        'so_number',
        'customer_id',
        'order_date',
        'delivery_date',
        'payment_terms',
        'discount',
        'total_amount',
        'status',
        'order_items',
        'notes'
    ];

    protected $casts = [
        'order_date' => 'date',
        'delivery_date' => 'date',
        'discount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'order_items' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoices::class, 'sales_order_id');
    }

    public function interactions(): HasMany
    {
        return $this->hasMany(\App\Models\CRM\Interactions::class, 'sales_order_id');
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function isShipped(): bool
    {
        return $this->status === 'shipped';
    }

    public function isDelivered(): bool
    {
        return $this->status === 'delivered';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function getItemsCountAttribute(): int
    {
        if (is_array($this->order_items)) {
            return count($this->order_items);
        }
        return 0;
    }

    public function getFormattedTotalAmountAttribute(): string
    {
        return '$' . number_format($this->total_amount, 2);
    }

    public function getFormattedDiscountAttribute(): string
    {
        return '$' . number_format($this->discount, 2);
    }

    public function getDaysToDeliveryAttribute(): int
    {
        if ($this->delivery_date) {
            return max(0, now()->diffInDays($this->delivery_date));
        }
        return 0;
    }

    public function getOverdueAttribute(): bool
    {
        if ($this->delivery_date && $this->status !== 'delivered') {
            return now()->gt($this->delivery_date);
        }
        return false;
    }

    public function getGrossAmountAttribute(): float
    {
        return $this->total_amount + $this->discount;
    }

    public function getFormattedGrossAmountAttribute(): string
    {
        return '$' . number_format($this->getGrossAmountAttribute(), 2);
    }

    public function getOrderItemsAttribute(): array
    {
        $value = $this->attributes['order_items'] ?? [];

        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }

        return is_array($value) ? $value : [];
    }

    public function setOrderItemsAttribute($value): void
    {
        $this->attributes['order_items'] = json_encode($value ?: []);
    }
}
