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
}
