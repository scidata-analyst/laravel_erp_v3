<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tax extends Model
{
    use HasFactory;
    protected $fillable = [
        'tax_name',
        'name',
        'tax_rate',
        'rate',
        'tax_type',
        'type',
        'applicable_to',
        'description',
        'effective_date',
        'status',
        'tax_code',
        'jurisdiction'
    ];

    protected $casts = [
        'tax_rate' => 'decimal:2',
        'effective_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(\App\Models\Accounting\Gl::class, 'tax_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(\App\Models\Sales\Invoices::class, 'tax_id');
    }

    public function salesOrders(): HasMany
    {
        return $this->hasMany(\App\Models\Sales\SalesOrders::class, 'tax_id');
    }

    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(\App\Models\Purchase\PurchaseOrders::class, 'tax_id');
    }

    public static function getTaxTypes(): array
    {
        return ['Sales Tax', 'VAT', 'Income Tax', 'Property Tax'];
    }

    public static function getApplicableToOptions(): array
    {
        return ['All Products', 'Specific Categories', 'Services'];
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isSalesTax(): bool
    {
        return $this->tax_type === 'Sales Tax';
    }

    public function isVAT(): bool
    {
        return $this->tax_type === 'VAT';
    }

    public function getNameAttribute(): string
    {
        return (string) $this->tax_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['tax_name'] = $value;
    }

    public function getRateAttribute(): float
    {
        return (float) $this->tax_rate;
    }

    public function setRateAttribute($value): void
    {
        $this->attributes['tax_rate'] = $value;
    }

    public function getTypeAttribute(): string
    {
        return (string) $this->tax_type;
    }

    public function setTypeAttribute(?string $value): void
    {
        $this->attributes['tax_type'] = $value;
    }
}
