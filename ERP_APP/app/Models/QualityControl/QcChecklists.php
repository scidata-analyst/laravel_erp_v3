<?php

namespace App\Models\QualityControl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class QcChecklists
 *
 * Laravel Eloquent model for QcChecklists table.
 */
class QcChecklists extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'qc_checklists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_batch_work_order',
        'inspector_id',
        'inspection_type',
        'inspection_date',
        'sample_size',
        'checklist_items_notes',
        'status',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the inspector for this QC checklist.
     */
    public function inspector(): BelongsTo
    {
        return $this->belongsTo(\App\Models\UsersRoles\User::class, 'inspector_id');
    }
}
