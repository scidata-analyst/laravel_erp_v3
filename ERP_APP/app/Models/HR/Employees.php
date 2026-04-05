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
        'name',
        'employee_code',
        'employee_id',
        'position',
        'department',
        'basic_salary',
        'salary',
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function attendance(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function performance(): HasMany
    {
        return $this->hasMany(Performance::class);
    }

    public function payroll(): HasMany
    {
        return $this->hasMany(Payroll::class);
    }

    public function managedWarehouses(): HasMany
    {
        return $this->hasMany(\App\Models\Logistics\Warehouses::class, 'manager_id');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(self::class, 'manager_id');
    }

    public function subordinates(): HasMany
    {
        return $this->hasMany(self::class, 'manager_id');
    }

    public function getNameAttribute(): string
    {
        return (string) $this->full_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['full_name'] = $value;
    }

    public function getEmployeeIdAttribute(): string
    {
        return (string) $this->employee_code;
    }

    public function setEmployeeIdAttribute(?string $value): void
    {
        $this->attributes['employee_code'] = $value;
    }

    public function getSalaryAttribute(): float
    {
        return (float) $this->basic_salary;
    }

    public function setSalaryAttribute($value): void
    {
        $this->attributes['basic_salary'] = $value;
    }

    public function getFirstNameAttribute(): string
    {
        return str($this->full_name)->before(' ')->toString();
    }

    public function getLastNameAttribute(): string
    {
        return str($this->full_name)->after(' ')->toString();
    }

    public function getDesignationAttribute(): ?string
    {
        return $this->position;
    }
}
