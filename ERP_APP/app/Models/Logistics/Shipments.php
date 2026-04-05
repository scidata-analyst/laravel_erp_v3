<?php

namespace App\Models\Logistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipments extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_number',
        'sales_order_id',
        'customer',
        'carrier',
        'tracking_number',
        'origin',
        'destination',
        'shipped_date',
        'estimated_arrival',
        'est_delivery_date',
        'actual_delivery_date',
        'status',
        'shipping_address',
        'cost',
        'notes'
    ];

    protected $casts = [
        'est_delivery_date' => 'date',
        'actual_delivery_date' => 'date',
        'cost' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function salesOrder(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Sales\SalesOrders::class);
    }

    public function isDelivered(): bool
    {
        return $this->status === 'Delivered';
    }

    public function isInTransit(): bool
    {
        return $this->status === 'In Transit';
    }

    public function isOverdue(): bool
    {
        return $this->est_delivery_date && $this->est_delivery_date < now() && !$this->isDelivered();
    }

    public function getOriginAttribute(): ?string
    {
        return null;
    }

    public function setOriginAttribute($value): void
    {
    }

    public function getDestinationAttribute(): ?string
    {
        return $this->shipping_address;
    }

    public function setDestinationAttribute(?string $value): void
    {
        $this->attributes['shipping_address'] = $value;
    }

    public function getShippedDateAttribute(): ?string
    {
        return $this->actual_delivery_date?->toDateString();
    }

    public function setShippedDateAttribute(?string $value): void
    {
        $this->attributes['actual_delivery_date'] = $value;
    }

    public function getEstimatedArrivalAttribute(): ?string
    {
        return $this->est_delivery_date?->toDateString();
    }

    public function setEstimatedArrivalAttribute(?string $value): void
    {
        $this->attributes['est_delivery_date'] = $value;
    }
}
