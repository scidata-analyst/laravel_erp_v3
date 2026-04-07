<?php

namespace App\Models\Logistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouses extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_name',
        'code',
        'type',
        'location_address',
        'manager_id',
        'capacity_units',
        'used_units',
        'status',
        'contact_phone',
        'email'
    ];
}
