<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoices extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        'customer_id',
        'sales_order_id',
        'invoice_date',
        'due_date',
        'amount',
        'tax',
        'paid_amount',
        'balance',
        'status',
        'notes',
        'generated_by',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'tax' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'balance' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class);
    }

    public function salesOrder(): BelongsTo
    {
        return $this->belongsTo(SalesOrders::class, 'sales_order_id');
    }

    public function generatedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'generated_by');
    }

    public function getComputedBalanceAttribute(): float
    {
        return $this->amount - $this->paid_amount;
    }

    public function getSalesOrderRefAttribute()
    {
        return $this->attributes['sales_order_id'] ?? null;
    }

    public function setSalesOrderRefAttribute($value): void
    {
        $this->attributes['sales_order_id'] = $value;
    }
}
