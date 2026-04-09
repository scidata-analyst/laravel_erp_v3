<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class WorkOrders
 *
 * Laravel Eloquent model for WorkOrders table.
 */
class WorkOrders extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'work_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bom_id',
        'quantity_to_produce',
        'priority',
        'start_date',
        'end_date',
        'workshop_line',
        'status',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the BOM for this work order.
     */
    public function bom(): BelongsTo
    {
        return $this->belongsTo(Bom::class, 'bom_id');
    }
}
