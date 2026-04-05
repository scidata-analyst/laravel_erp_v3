<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'setting_key',
        'setting_value',
        'setting_type',
        'category',
        'description',
        'is_system',
        'updated_by',
        'validation_rules'
    ];

    protected $casts = [
        'setting_value' => 'json',
        'is_system' => 'boolean',
        'validation_rules' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }

    public function isString(): bool
    {
        return $this->setting_type === 'string';
    }

    public function isNumber(): bool
    {
        return $this->setting_type === 'number';
    }

    public function isBoolean(): bool
    {
        return $this->setting_type === 'boolean';
    }

    public function isArray(): bool
    {
        return $this->setting_type === 'array';
    }

    public function isJson(): bool
    {
        return $this->setting_type === 'json';
    }

    public function isSystemSetting(): bool
    {
        return $this->is_system === true;
    }

    public function isUserSetting(): bool
    {
        return $this->is_system === false;
    }

    public function getFormattedValueAttribute()
    {
        if ($this->isString()) {
            return $this->setting_value;
        } elseif ($this->isNumber()) {
            return is_numeric($this->setting_value) ? $this->setting_value : 0;
        } elseif ($this->isBoolean()) {
            return $this->setting_value ? 'true' : 'false';
        } elseif ($this->isArray() || $this->isJson()) {
            return json_decode($this->setting_value, true);
        }

        return $this->setting_value;
    }

    public static function getByCategory(string $category): array
    {
        return self::where('category', $category)->pluck('setting_value', 'setting_key')->toArray();
    }

    public static function getSystemSettings(): array
    {
        return self::where('is_system', true)->pluck('setting_value', 'setting_key')->toArray();
    }

    public static function getUserSettings(): array
    {
        return self::where('is_system', false)->pluck('setting_value', 'setting_key')->toArray();
    }
}
