<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OnlineChannels extends Model
{
    use HasFactory;
    protected $fillable = [
        'channel_name',
        'name',
        'platform',
        'api_endpoint',
        'api_key',
        'webhook_url',
        'sync_frequency',
        'last_sync_date',
        'status',
        'default_currency',
        'tax_inclusive',
        'shipping_methods',
        'payment_methods',
        'configuration',
        'last_sync'
    ];

    protected $casts = [
        'last_sync_date' => 'datetime',
        'tax_inclusive' => 'boolean',
        'shipping_methods' => 'array',
        'payment_methods' => 'array',
        'configuration' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(\App\Models\Sales\SalesOrders::class, 'channel_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(\App\Models\Inventory\ProductCatalog::class, 'channel_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isShopify(): bool
    {
        return $this->platform === 'shopify';
    }

    public function isWooCommerce(): bool
    {
        return $this->platform === 'woocommerce';
    }

    public function isMagento(): bool
    {
        return $this->platform === 'magento';
    }

    public function getSyncStatusAttribute(): string
    {
        if (!$this->last_sync_date) {
            return 'Never synced';
        }

        $hoursSinceSync = now()->diffInHours($this->last_sync_date);

        if ($hoursSinceSync < 1) {
            return 'Just synced';
        } elseif ($hoursSinceSync < 24) {
            return 'Synced today';
        } elseif ($hoursSinceSync < 168) {
            return 'Synced this week';
        } else {
            return 'Sync overdue';
        }
    }

    public function getFormattedConfigurationAttribute(): array
    {
        return $this->configuration ?? [];
    }

    public function getNameAttribute(): string
    {
        return (string) $this->channel_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['channel_name'] = $value;
    }

    public function getLastSyncAttribute(): ?string
    {
        return $this->last_sync_date?->toDateTimeString();
    }

    public function setLastSyncAttribute(?string $value): void
    {
        $this->attributes['last_sync_date'] = $value;
    }
}
