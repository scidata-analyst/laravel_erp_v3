<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discounts extends Model
{
    use HasFactory;
    protected $fillable = [
        'discount_name',
        'name',
        'discount_type',
        'type',
        'discount_value',
        'value',
        'applicable_to',
        'start_date',
        'valid_from',
        'end_date',
        'valid_to',
        'usage_limit',
        'max_uses',
        'used_count',
        'status',
        'description',
        'created_by'
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function salesOrders(): HasMany
    {
        return $this->hasMany(SalesOrders::class, 'discount_id');
    }

    public function isPercentage(): bool
    {
        return $this->discount_type === 'percentage';
    }

    public function isFixedAmount(): bool
    {
        return $this->discount_type === 'fixed';
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

    public function getRemainingUsageAttribute(): int
    {
        return max(0, $this->usage_limit - $this->used_count);
    }

    public function getFormattedDiscountValueAttribute(): string
    {
        if ($this->isPercentage()) {
            return $this->discount_value . '%';
        }
        return '$' . number_format($this->discount_value, 2);
    }

    public function getNameAttribute(): string
    {
        return (string) $this->discount_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['discount_name'] = $value;
    }

    public function getTypeAttribute(): string
    {
        return (string) $this->discount_type;
    }

    public function setTypeAttribute(?string $value): void
    {
        $this->attributes['discount_type'] = $value;
    }

    public function getValueAttribute(): float
    {
        return (float) $this->discount_value;
    }

    public function setValueAttribute($value): void
    {
        $this->attributes['discount_value'] = $value;
    }

    public function getValidFromAttribute(): ?string
    {
        return $this->start_date?->toDateString();
    }

    public function setValidFromAttribute(?string $value): void
    {
        $this->attributes['start_date'] = $value;
    }

    public function getValidToAttribute(): ?string
    {
        return $this->end_date?->toDateString();
    }

    public function setValidToAttribute(?string $value): void
    {
        $this->attributes['end_date'] = $value;
    }

    public function getMaxUsesAttribute(): int
    {
        return (int) $this->usage_limit;
    }

    public function setMaxUsesAttribute($value): void
    {
        $this->attributes['usage_limit'] = $value;
    }
}
