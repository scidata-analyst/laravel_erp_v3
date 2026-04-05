<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'name',
        'contact_person',
        'email',
        'phone',
        'credit_limit',
        'sales_rep',
        'billing_address',
        'shipping_address',
        'status',
        'tax_id',
        'payment_terms'
    ];

    protected $casts = [
        'credit_limit' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function salesOrders(): HasMany
    {
        return $this->hasMany(SalesOrders::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoices::class);
    }

    public function apArTransactions(): HasMany
    {
        return $this->hasMany(\App\Models\Accounting\ApAr::class, 'party_name', 'company_name');
    }

    public function getNameAttribute(): string
    {
        return (string) $this->company_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['company_name'] = $value;
    }

    public function getOutstandingAttribute(): float
    {
        if ($this->relationLoaded('apArTransactions')) {
            return (float) $this->apArTransactions->sum('balance');
        }

        return (float) $this->apArTransactions()->sum('balance');
    }

    public function getOutstandingBalanceAttribute(): float
    {
        return $this->getOutstandingAttribute();
    }
}
