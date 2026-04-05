<?php

namespace App\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pos extends Model
{
    use HasFactory;
    protected $fillable = [
        'terminal_id',
        'location',
        'cashier',
        'session_start',
        'sales',
        'transactions',
        'status',
        'receipt_printer',
        'warehouse_id',
    ];

    protected $casts = [
        'cash_drawer_balance' => 'decimal:2',
        'last_sync_date' => 'datetime',
        'offline_mode' => 'boolean',
        'configuration' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function currentUser(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'current_user_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(\App\Models\Ecommerce\PosTransactions::class, 'terminal_id');
    }

    public function inventorySyncs(): HasMany
    {
        return $this->hasMany(\App\Models\Ecommerce\InvSync::class, 'terminal_id');
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isOffline(): bool
    {
        return $this->offline_mode === true;
    }

    public function isOnline(): bool
    {
        return $this->offline_mode === false;
    }

    public function isOpen(): bool
    {
        return $this->session_status === 'open';
    }

    public function isClosed(): bool
    {
        return $this->session_status === 'closed';
    }

    public function getSyncStatusAttribute(): string
    {
        if (!$this->last_sync_date) {
            return 'Never synced';
        }

        $minutesSinceSync = now()->diffInMinutes($this->last_sync_date);

        if ($minutesSinceSync < 5) {
            return 'Just synced';
        } elseif ($minutesSinceSync < 60) {
            return 'Synced recently';
        } elseif ($minutesSinceSync < 1440) {
            return 'Synced today';
        } else {
            return 'Sync overdue';
        }
    }

    public function getFormattedCashBalanceAttribute(): string
    {
        return '$' . number_format($this->cash_drawer_balance, 2);
    }
}
