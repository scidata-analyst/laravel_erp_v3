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
        'tax_id'
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'tax' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'balance' => 'decimal:2',
    ];
}
