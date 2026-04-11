<?php

namespace App\Models\Logistics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Warehouses
 *
 * Laravel Eloquent model for Warehouses table.
 */
class Warehouses extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'warehouses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'warehouse_name',
        'warehouse_code',
        'warehouse_type',
        'location_address',
        'manager_id',
        'capacity_units',
        'status',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the warehouse manager.
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(\App\Models\UsersRoles\User::class, 'manager_id');
    }

    /**
     * Get the products in this warehouse.
     */
    public function products(): HasMany
    {
        return $this->hasMany(\App\Models\Inventory\ProductCatalog::class, 'warehouse_id');
    }
}
