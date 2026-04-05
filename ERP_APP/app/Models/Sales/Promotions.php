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
        'name',
        'discount_id',
        'start_date',
        'end_date',
        'applicable_products',
        'minimum_purchase',
        'min_order_amount',
        'usage_limit',
        'used_count',
        'status',
        'description',
        'created_by'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'applicable_products' => 'array',
        'minimum_purchase' => 'decimal:2',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discounts::class, 'discount_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function salesOrders(): HasMany
    {
        return $this->hasMany(SalesOrders::class, 'promotion_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active' &&
               now()->between($this->start_date, $this->end_date);
    }

    public function isExpired(): bool
    {
        return now()->gt($this->end_date);
    }

    public function isUpcoming(): bool
    {
        return now()->lt($this->start_date);
    }

    public function getRemainingUsageAttribute(): int
    {
        return max(0, $this->usage_limit - $this->used_count);
    }

    public function getUsagePercentageAttribute(): float
    {
        if ($this->usage_limit > 0) {
            return ($this->used_count / $this->usage_limit) * 100;
        }
        return 0;
    }

    public function getApplicableProductsCountAttribute(): int
    {
        if (is_array($this->applicable_products)) {
            return count($this->applicable_products);
        }
        return 0;
    }

    public function getDaysRemainingAttribute(): int
    {
        if ($this->end_date) {
            return max(0, now()->diffInDays($this->end_date));
        }
        return 0;
    }

    public function getNameAttribute(): string
    {
        return (string) $this->promotion_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['promotion_name'] = $value;
    }

    public function getValueAttribute(): float
    {
        return (float) optional($this->discount)->discount_value;
    }

    public function getTypeAttribute(): string
    {
        return (string) optional($this->discount)->discount_type;
    }

    public function getDiscountValueAttribute(): float
    {
        return $this->getValueAttribute();
    }

    public function getDiscountTypeAttribute(): string
    {
        return $this->getTypeAttribute();
    }

    public function getMinOrderAmountAttribute(): float
    {
        return (float) $this->minimum_purchase;
    }

    public function setMinOrderAmountAttribute($value): void
    {
        $this->attributes['minimum_purchase'] = $value;
    }

    public function getMinPurchaseAmountAttribute(): float
    {
        return $this->getMinOrderAmountAttribute();
    }
}
