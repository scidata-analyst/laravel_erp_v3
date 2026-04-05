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
        'entry_date',
        'reference_number',
        'reference',
        'status'
    ];

    protected $casts = [
        'debit' => 'decimal:2',
        'credit' => 'decimal:2',
        'balance' => 'decimal:2',
        'transaction_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function children(): HasMany
    {
        return $this->hasMany(\App\Models\Accounting\Gl::class, 'parent_account_id');
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Accounting\Gl::class, 'parent_account_id');
    }

    public static function getAccountTypes(): array
    {
        return ['Asset', 'Liability', 'Equity', 'Revenue', 'Expense'];
    }

    public function getComputedBalanceAttribute(): float
    {
        return $this->credit - $this->debit;
    }

    public function isAsset(): bool
    {
        return $this->account_type === 'Asset';
    }

    public function isLiability(): bool
    {
        return $this->account_type === 'Liability';
    }

    public function isRevenue(): bool
    {
        return $this->account_type === 'Revenue';
    }

    public function isExpense(): bool
    {
        return $this->account_type === 'Expense';
    }

    public function getEntryDateAttribute(): ?string
    {
        return $this->transaction_date?->toDateString();
    }

    public function setEntryDateAttribute(?string $value): void
    {
        $this->attributes['transaction_date'] = $value;
    }

    public function getReferenceAttribute(): ?string
    {
        return $this->reference_number;
    }

    public function setReferenceAttribute(?string $value): void
    {
        $this->attributes['reference_number'] = $value;
    }
}
