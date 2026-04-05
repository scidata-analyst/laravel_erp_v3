<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrders extends Model
{
    use HasFactory;
    protected $fillable = [
        'po_number',
        'supplier_id',
        'order_date',
        'expected_delivery',
        'warehouse',
        'payment_terms',
        'total_amount',
        'status',
        'approved_by',
        'order_items',
        'notes'
    ];

    protected $casts = [
        'order_date' => 'date',
        'expected_delivery' => 'date',
        'total_amount' => 'decimal:2',
        'order_items' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Suppliers::class);
    }

    public function grns(): HasMany
    {
        return $this->hasMany(Grn::class, 'purchase_order_id');
    }

    public function supplierPayments(): HasMany
    {
        return $this->hasMany(SupplierPayments::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'approved_by');
    }

    public function getOrderItemsAttribute(): array
    {
        $value = $this->attributes['order_items'] ?? [];

        if (is_string($value)) {
            return json_decode($value, true) ?: [];
        }

        return is_array($value) ? $value : [];
    }

    public function setOrderItemsAttribute($value): void
    {
        $this->attributes['order_items'] = json_encode($value ?: []);
    }
}
