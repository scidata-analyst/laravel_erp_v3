<?php

namespace App\Models\UsersRoles;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Roles extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'permissions',
        'is_active',
        'created_by'
    ];

    protected $casts = [
        'permissions' => 'array',
        'is_system_role' => 'boolean',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function users(): HasMany
    {
        return $this->hasMany(\App\Models\User::class, 'role_id');
    }

    public function isSystemRole(): bool
    {
        return $this->is_system_role === true;
    }

    public function isUserRole(): bool
    {
        return $this->is_system_role === false;
    }

    public function isActive(): bool
    {
        return $this->is_active === true;
    }

    public function isInactive(): bool
    {
        return $this->is_active === false;
    }

    public function hasPermission(string $permission): bool
    {
        if (is_array($this->permissions)) {
            return in_array($permission, $this->permissions);
        }
        return false;
    }

    public function getPermissionsCountAttribute(): int
    {
        if (is_array($this->permissions)) {
            return count($this->permissions);
        }
        return 0;
    }

    public function getFormattedPermissionsAttribute(): array
    {
        return $this->permissions ?? [];
    }

    public static function getAvailablePermissions(): array
    {
        return [
            'users.create', 'users.read', 'users.update', 'users.delete',
            'customers.create', 'customers.read', 'customers.update', 'customers.delete',
            'products.create', 'products.read', 'products.update', 'products.delete',
            'orders.create', 'orders.read', 'orders.update', 'orders.delete',
            'invoices.create', 'invoices.read', 'invoices.update', 'invoices.delete',
            'reports.create', 'reports.read', 'reports.update',
            'settings.read', 'settings.update'
        ];
    }

    public function getNameAttribute(): string
    {
        return (string) $this->role_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['role_name'] = $value;
    }
}
