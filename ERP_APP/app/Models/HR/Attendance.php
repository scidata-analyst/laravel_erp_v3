<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'check_in',
        'check_out',
        'status',
        'leave_type',
        'hours_worked',
        'overtime_hours',
        'notes',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employees::class);
    }
}
