<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectCost
 *
 * Laravel Eloquent model for ProjectCost table.
 */
class ProjectCost extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_costs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_name',
        'cost_category',
        'amount',
        'date_incurred',
        'approved_by_user_id',
        'description',
        'status',
    ];

    public function approvedByUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(\App\Models\UsersRoles\User::class, 'approved_by_user_id');
    }

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}
