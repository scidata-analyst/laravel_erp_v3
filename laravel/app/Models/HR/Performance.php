<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Performance
 *
 * Laravel Eloquent model for Performance table.
 */
class Performance extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'performance_reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'review_period',
        'kpi_score',
        'goal_achievement',
        'overall_rating',
        'reviewer_comments',
        'status',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the employee for this performance review.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employees::class, 'employee_id');
    }
}
