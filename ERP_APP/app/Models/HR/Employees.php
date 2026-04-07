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
        'employee_code',
        'full_name',
        'position',
        'department',
        'phone',
        'join_date',
        'basic_salary',
        'status',
        'contract_type',
        'email',
        'address',
        'manager_id'
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
