<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_person',
        'email',
        'phone',
        'credit_limit',
        'sales_rep',
        'billing_address',
        'outstanding',
        'status',
    ];

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoices::class);
    }

    public function salesOrders(): HasMany
    {
        return $this->hasMany(SalesOrders::class);
    }
}
