<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Suppliers extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'name',
        'contact_person',
        'email',
        'phone',
        'country',
        'payment_terms',
        'currency',
        'address',
        'status',
        'rating',
        'tax_id',
        'website'
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrders::class);
    }

    public function supplierPayments(): HasMany
    {
        return $this->hasMany(SupplierPayments::class);
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

    public function getApArBalanceAttribute(): float
    {
        if ($this->relationLoaded('apArTransactions')) {
            return (float) $this->apArTransactions->sum('balance');
        }

        return (float) $this->apArTransactions()->sum('balance');
    }
}
