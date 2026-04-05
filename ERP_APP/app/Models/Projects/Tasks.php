<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tasks extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_name',
        'project_id',
        'task_title',
        'title',
        'description',
        'assigned_to',
        'start_date',
        'end_date',
        'due_date',
        'priority',
        'status',
        'progress_percentage',
        'progress',
        'estimated_hours',
        'actual_hours',
        'dependencies'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'progress_percentage' => 'integer',
        'estimated_hours' => 'decimal:2',
        'actual_hours' => 'decimal:2',
        'dependencies' => 'json',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function projectCosts(): HasMany
    {
        return $this->hasMany(ProjectCost::class, 'project_id');
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'assigned_to');
    }

    public function getDependenciesAttribute(): array
    {
        return $this->attributes['dependencies'] ?? [];
    }

    public function setDependenciesAttribute(array $value): void
    {
        $this->attributes['dependencies'] = json_encode($value);
    }

    public function getTitleAttribute(): string
    {
        return (string) $this->task_title;
    }

    public function setTitleAttribute(?string $value): void
    {
        $this->attributes['task_title'] = $value;
    }

    public function getProjectIdAttribute(): ?string
    {
        return $this->project_name;
    }

    public function setProjectIdAttribute($value): void
    {
        $this->attributes['project_name'] = $value;
    }

    public function getDueDateAttribute(): ?string
    {
        return $this->end_date?->toDateString();
    }

    public function setDueDateAttribute(?string $value): void
    {
        $this->attributes['end_date'] = $value;
    }

    public function getProgressAttribute(): int
    {
        return (int) $this->progress_percentage;
    }

    public function setProgressAttribute($value): void
    {
        $this->attributes['progress_percentage'] = $value;
    }
}
