<?php

namespace App\Models\QualityControl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Defects
 *
 * Laravel Eloquent model for Defects table.
 */
class Defects extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'defects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'batch_lot_number',
        'defect_type',
        'severity',
        'quantity_affected',
        'description_root_cause',
        'status',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the product for this defect.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Inventory\ProductCatalog::class, 'product_id');
    }
}
