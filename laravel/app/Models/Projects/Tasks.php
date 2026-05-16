<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Tasks
 *
 * Laravel Eloquent model for Tasks table.
 */
class Tasks extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_title',
        'project_name',
        'assigned_user_id',
        'priority',
        'due_date',
        'status',
        'description',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the assigned user for this task.
     */
    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(\App\Models\UsersRoles\User::class, 'assigned_user_id');
    }
}
