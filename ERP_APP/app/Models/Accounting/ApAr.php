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
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Sales\Customers::class, 'party_name', 'company_name');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Purchase\Suppliers::class, 'party_name', 'company_name');
    }

    public function getComputedBalanceAttribute(): float
    {
        return $this->amount - $this->paid;
    }
}
