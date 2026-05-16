<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Employees
 *
 * Laravel Eloquent model for Employees table.
 */
class Employees extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'employee_id',
        'designation',
        'department',
        'basic_salary',
        'join_date',
        'contract_type',
        'email',
        'phone',
        'status',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the attendance records for this employee.
     */
    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(Attendance::class, 'employee_id');
    }

    /**
     * Get the payroll records for this employee.
     */
    public function payrollRecords(): HasMany
    {
        return $this->hasMany(Payroll::class, 'employee_id');
    }

    /**
     * Get the performance reviews for this employee.
     */
    public function performanceReviews(): HasMany
    {
        return $this->hasMany(Performance::class, 'employee_id');
    }
}
