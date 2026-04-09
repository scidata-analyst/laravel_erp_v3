<?php

namespace App\DTOs\HR;

use App\Models\HR\Payroll;

class PayrollDTO
{
    public ?int $id;

    public ?int $employeeId;

    public ?string $payrollPeriod;

    public ?float $basicSalary;

    public ?float $allowances;

    public ?float $deductions;

    public ?float $netPay;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?EmployeesDTO $employee;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->employeeId = isset($data['employee_id']) ? (int) $data['employee_id'] : null;
        $this->payrollPeriod = $data['payroll_period'] ?? null;
        $this->basicSalary = isset($data['basic_salary']) ? (float) $data['basic_salary'] : null;
        $this->allowances = isset($data['allowances']) ? (float) $data['allowances'] : null;
        $this->deductions = isset($data['deductions']) ? (float) $data['deductions'] : null;
        $this->netPay = isset($data['net_pay']) ? (float) $data['net_pay'] : null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->employee = $data['employee'] ?? null;
    }

    public static function fromModel(Payroll $model): self
    {
        $data = [
            'id' => $model->id,
            'employee_id' => $model->employee_id,
            'payroll_period' => $model->payroll_period,
            'basic_salary' => $model->basic_salary,
            'allowances' => $model->allowances,
            'deductions' => $model->deductions,
            'net_pay' => $model->net_pay,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('employee')) {
            $data['employee'] = EmployeesDTO::fromModel($model->employee);
        }

        return new self($data);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employeeId,
            'payroll_period' => $this->payrollPeriod,
            'basic_salary' => $this->basicSalary,
            'allowances' => $this->allowances,
            'deductions' => $this->deductions,
            'net_pay' => $this->netPay,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'employee_id' => $this->employeeId,
            'payroll_period' => $this->payrollPeriod,
            'basic_salary' => $this->basicSalary,
            'allowances' => $this->allowances,
            'deductions' => $this->deductions,
            'net_pay' => $this->netPay,
            'status' => $this->status,
        ];
    }
}
