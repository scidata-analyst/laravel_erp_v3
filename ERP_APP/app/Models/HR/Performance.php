<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'review_period',
        'kpi_score',
        'goal_achievement',
        'overall_rating',
        'reviewer_id',
        'reviewer',
        'reviewer_comments',
        'comments',
        'review_date',
        'status',
        'improvement_plan',
        'rating'
    ];

    protected $casts = [
        'kpi_score' => 'decimal:2',
        'goal_achievement' => 'decimal:2',
        'review_date' => 'date',
        'improvement_plan' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employees::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(Employees::class, 'reviewer_id');
    }

    public function isExcellent(): bool
    {
        return $this->overall_rating === 'Excellent';
    }

    public function needsImprovement(): bool
    {
        return $this->overall_rating === 'Poor' || $this->kpi_score < 70;
    }

    public function getRatingAttribute(): ?string
    {
        return $this->overall_rating;
    }

    public function setRatingAttribute(?string $value): void
    {
        $this->attributes['overall_rating'] = $value;
    }

    public function getCommentsAttribute(): ?string
    {
        return $this->reviewer_comments;
    }

    public function setCommentsAttribute(?string $value): void
    {
        $this->attributes['reviewer_comments'] = $value;
    }

    public function getReviewerAttribute(): ?string
    {
        if ($this->relationLoaded('reviewer') && $this->reviewer) {
            return $this->reviewer->full_name;
        }

        return null;
    }
}
