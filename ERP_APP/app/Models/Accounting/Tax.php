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
        'tax_rate',
        'tax_type',
        'applicable_to',
        'filling_period',
        'status',
        'last_filed_date',
    ];
}
