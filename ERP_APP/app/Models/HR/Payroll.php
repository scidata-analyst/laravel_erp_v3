<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'pay_period',
        'basic_salary',
        'overtime_hours',
        'overtime_rate',
        'bonus',
        'deductions',
        'net_pay',
        'pay_date',
        'payment_method',
        'status'
    ];

    protected $casts = [
        'basic_salary' => 'decimal:2',
        'overtime_hours' => 'decimal:2',
        'overtime_rate' => 'decimal:2',
        'bonus' => 'decimal:2',
        'deductions' => 'json',
        'net_pay' => 'decimal:2',
        'pay_date' => 'date',
    ];
}
