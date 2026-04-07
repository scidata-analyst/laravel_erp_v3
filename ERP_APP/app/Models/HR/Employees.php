<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'employee_code',
        'position',
        'department',
        'basic_salary',
        'join_date',
        'contract_type',
        'email',
        'phone',
        'address',
        'status',
        'manager_id'
    ];

    protected $casts = [
        'basic_salary' => 'decimal:2',
        'join_date' => 'date',
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Employees::class, 'manager_id');
    }

    public function subordinates(): HasMany
    {
        return $this->hasMany(Employees::class, 'manager_id');
    }

    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function payroll(): HasMany
    {
        return $this->hasMany(Payroll::class);
    }
}
