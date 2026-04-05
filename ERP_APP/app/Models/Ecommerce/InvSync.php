<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvSync extends Model
{
    use HasFactory;
    protected $fillable = [
        'sync_reference',
        'terminal_id',
        'channel_id',
        'sync_type',
        'records_synced',
        'started_at',
        'completed_at',
        'product_sku',
        'online_quantity',
        'local_quantity',
        'variance',
        'sync_date',
        'status',
        'error_message',
        'retry_count'
    ];

    protected $casts = [
        'online_quantity' => 'decimal:2',
        'local_quantity' => 'decimal:2',
        'variance' => 'decimal:2',
        'sync_date' => 'datetime',
        'retry_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function terminal(): BelongsTo
    {
        return $this->belongsTo(Pos::class, 'terminal_id');
    }

    public function channel(): BelongsTo
    {
        return $this->belongsTo(OnlineChannels::class, 'channel_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Inventory\ProductCatalog::class, 'product_sku', 'sku');
    }

    public function isSuccessful(): bool
    {
        return $this->status === 'success';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isInSync(): bool
    {
        return $this->status === 'in_progress';
    }

    public function hasVariance(): bool
    {
        return $this->variance !== 0;
    }

    public function isOverstock(): bool
    {
        return $this->variance > 0;
    }

    public function isUnderstock(): bool
    {
        return $this->variance < 0;
    }

    public function getVariancePercentageAttribute(): float
    {
        if ($this->online_quantity != 0) {
            return ($this->variance / $this->online_quantity) * 100;
        }
        return 0;
    }

    public function getFormattedVarianceAttribute(): string
    {
        $prefix = $this->variance >= 0 ? '+' : '';
        return $prefix . number_format(abs($this->variance), 2);
    }

    public function getRecordsSyncedAttribute(): float
    {
        return (float) abs($this->variance);
    }

    public function setRecordsSyncedAttribute($value): void
    {
    }

    public function getStartedAtAttribute(): ?string
    {
        return $this->sync_date?->toDateTimeString();
    }

    public function setStartedAtAttribute(?string $value): void
    {
        $this->attributes['sync_date'] = $value;
    }

    public function getCompletedAtAttribute(): ?string
    {
        return $this->updated_at?->toDateTimeString();
    }

    public function setCompletedAtAttribute($value): void
    {
    }
}
