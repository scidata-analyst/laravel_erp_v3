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
        'validation_rules' => 'json',
    ];
}
