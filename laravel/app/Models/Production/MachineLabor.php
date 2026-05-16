<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MachineLabor
 *
 * Laravel Eloquent model for MachineLabor table.
 */
class MachineLabor extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'machine_labor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'work_order_id',
        'resource_name',
        'resource_type',
        'hours_used',
        'cost_per_hour',
        'total_cost',
    ];

    public function workOrder(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(\App\Models\Production\WorkOrders::class, 'work_order_id');
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
