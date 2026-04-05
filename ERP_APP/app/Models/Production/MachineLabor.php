<?php

namespace App\Models\Production;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MachineLabor extends Model
{
    use HasFactory;
    protected $fillable = [
        'work_order_id',
        'machine_id',
        'operator_id',
        'resource_name',
        'resource_type',
        'hours',
        'rate',
        'start_time',
        'end_time',
        'output_quantity',
        'scrap_quantity',
        'status',
        'notes'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'output_quantity' => 'integer',
        'scrap_quantity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function workOrder(): BelongsTo
    {
        return $this->belongsTo(WorkOrders::class, 'work_order_id');
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(\App\Models\HR\Employees::class, 'operator_id');
    }

    public function getDurationAttribute(): int
    {
        if ($this->start_time && $this->end_time) {
            return $this->end_time->diffInMinutes($this->start_time);
        }
        return 0;
    }

    public function getEfficiencyAttribute(): float
    {
        $duration = $this->getDurationAttribute();
        if ($duration > 0 && $this->output_quantity > 0) {
            return $this->output_quantity / ($duration / 60);
        }
        return 0;
    }

    public function getHoursAttribute(): float
    {
        return round($this->getDurationAttribute() / 60, 2);
    }

    public function setHoursAttribute($value): void
    {
        $hours = (float) $value;
        $baseTime = $this->start_time ?? now();

        if (!$baseTime instanceof \Illuminate\Support\Carbon) {
            $baseTime = \Illuminate\Support\Carbon::parse($baseTime);
        }

        $this->attributes['start_time'] = $baseTime;
        $this->attributes['end_time'] = $baseTime->copy()->addMinutes((int) round($hours * 60));
    }
}
