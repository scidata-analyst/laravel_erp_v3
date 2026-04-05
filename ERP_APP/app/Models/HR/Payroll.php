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
        'period_start',
        'period_end',
        'basic_salary',
        'overtime_hours',
        'overtime_rate',
        'bonus',
        'deductions',
        'net_pay',
        'net_salary',
        'pay_date',
        'payment_date',
        'payment_method',
        'status'
    ];

    protected $casts = [
        'basic_salary' => 'decimal:2',
        'overtime_hours' => 'decimal:2',
        'overtime_rate' => 'decimal:2',
        'bonus' => 'decimal:2',
        'deductions' => 'array',
        'net_pay' => 'decimal:2',
        'pay_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(\App\Models\HR\Employees::class, 'employee_id');
    }

    public function getGrossPayAttribute(): float
    {
        return $this->basic_salary + $this->overtime_hours * $this->overtime_rate + $this->bonus;
    }

    public function getTotalDeductionsAttribute(): float
    {
        if (is_array($this->deductions)) {
            return array_sum($this->deductions);
        }
        return (float) $this->deductions;
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function getFormattedNetPayAttribute(): string
    {
        return number_format($this->net_pay, 2);
    }

    public function getPeriodStartAttribute(): ?string
    {
        if (blank($this->pay_period)) {
            return null;
        }

        return str($this->pay_period)->before('|')->toString();
    }

    public function setPeriodStartAttribute(?string $value): void
    {
        $this->attributes['pay_period'] = implode('|', [
            $value,
            $this->getPeriodEndAttribute(),
        ]);
    }

    public function getPeriodEndAttribute(): ?string
    {
        if (blank($this->pay_period)) {
            return null;
        }

        return str($this->pay_period)->after('|')->toString();
    }

    public function setPeriodEndAttribute(?string $value): void
    {
        $this->attributes['pay_period'] = implode('|', [
            $this->getPeriodStartAttribute(),
            $value,
        ]);
    }

    public function getNetSalaryAttribute(): float
    {
        return (float) $this->net_pay;
    }

    public function setNetSalaryAttribute($value): void
    {
        $this->attributes['net_pay'] = $value;
    }

    public function getPaymentDateAttribute(): ?string
    {
        return $this->pay_date?->toDateString();
    }

    public function setPaymentDateAttribute(?string $value): void
    {
        $this->attributes['pay_date'] = $value;
    }
}
