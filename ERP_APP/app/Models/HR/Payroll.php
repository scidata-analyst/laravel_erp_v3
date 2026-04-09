<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Payroll
 *
 * Laravel Eloquent model for Payroll table.
 */
class Payroll extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payroll';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id',
        'payroll_period',
        'basic_salary',
        'allowances',
        'deductions',
        'net_pay',
        'status',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the employee for this payroll record.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employees::class, 'employee_id');
    }
}
