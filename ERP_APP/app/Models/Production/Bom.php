<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Bom
 *
 * Laravel Eloquent model for Bill of Materials table.
 */
class Bom extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bill_of_materials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'finished_product_name',
        'version',
        'lead_time_days',
        'status',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the work orders for this BOM.
     */
    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrders::class, 'bom_id');
    }
}
