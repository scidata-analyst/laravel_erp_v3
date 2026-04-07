<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gl extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_code',
        'account_name',
        'account_type',
        'debit',
        'credit',
        'balance',
        'description',
        'transaction_date',
        'reference_number',
        'status',
        'parent_account_id'
    ];

    protected $casts = [
        'debit' => 'decimal:2',
        'credit' => 'decimal:2',
        'balance' => 'decimal:2',
        'transaction_date' => 'date',
    ];
}
