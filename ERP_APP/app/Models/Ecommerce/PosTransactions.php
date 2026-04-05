<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PosTransactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_number',
        'terminal_id',
        'transaction_type',
        'payment_method',
        'amount',
        'tax_amount',
        'total_amount',
        'customer_id',
        'order_reference',
        'items',
        'cash_tendered',
        'change_given',
        'transaction_date',
        'status'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'cash_tendered' => 'decimal:2',
        'change_given' => 'decimal:2',
        'items' => 'array',
        'transaction_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function terminal(): BelongsTo
    {
        return $this->belongsTo(Pos::class, 'terminal_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Sales\Customers::class, 'customer_id');
    }

    public function salesOrder(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Sales\SalesOrders::class, 'order_reference');
    }

    public function isSale(): bool
    {
        return $this->transaction_type === 'sale';
    }

    public function isReturn(): bool
    {
        return $this->transaction_type === 'return';
    }

    public function isRefund(): bool
    {
        return $this->transaction_type === 'refund';
    }

    public function isCashPayment(): bool
    {
        return $this->payment_method === 'cash';
    }

    public function isCardPayment(): bool
    {
        return $this->payment_method === 'card';
    }

    public function isMobilePayment(): bool
    {
        return $this->payment_method === 'mobile';
    }

    public function getItemsCountAttribute(): int
    {
        if (is_array($this->items)) {
            return count($this->items);
        }
        return 0;
    }

    public function getFormattedAmountAttribute(): string
    {
        return '$' . number_format((float) $this->amount, 2);
    }

    public function getFormattedTotalAmountAttribute(): string
    {
        return '$' . number_format((float) $this->total_amount, 2);
    }

    public function getProfitAttribute(): float
    {
        return $this->total_amount - $this->amount - $this->tax_amount;
    }

    public function getFormattedProfitAttribute(): string
    {
        return '$' . number_format($this->getProfitAttribute(), 2);
    }

    public function getTransactionDateFormattedAttribute(): string
    {
        return $this->transaction_date ? $this->transaction_date->format('M d, Y H:i') : '';
    }
}
