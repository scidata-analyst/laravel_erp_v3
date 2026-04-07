<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApAr extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref_number',
        'party_name',
        'type',
        'due_date',
        'amount',
        'paid',
        'balance',
        'status',
        'reference',
        'description'
    ];

    protected $casts = [
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'paid' => 'decimal:2',
        'balance' => 'decimal:2',
    ];
}
