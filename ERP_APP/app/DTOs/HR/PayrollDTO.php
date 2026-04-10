<?php

namespace App\DTOs\HR;

use App\Models\HR\Payroll;

/**
 * Data Transfer Object for Payroll entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates employee payroll/salary data.
 *
 * @property int|null $id
 * @property int|null $employeeId
 * @property string|null $payrollPeriod
 * @property float|null $basicSalary
 * @property float|null $allowances
 * @property float|null $deductions
 * @property float|null $netPay
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property EmployeesDTO|null $employee
 */
class PayrollDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to employees table */
    public ?int $employeeId;

    /** @var string|null Payroll period (e.g., '2024-01', '2024-Q1') */
    public ?string $payrollPeriod;

    /** @var float|null Base salary amount */
    public ?float $basicSalary;

    /** @var float|null Total allowances (overtime, housing, transport, etc.) */
    public ?float $allowances;

    /** @var float|null Total deductions (tax, insurance, late fines, etc.) */
    public ?float $deductions;

    /** @var float|null Net pay after deductions (basic + allowances - deductions) */
    public ?float $netPay;

    /** @var int|null Status: 0=Pending, 1=Processing, 2=Paid, 3=Cancelled */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var EmployeesDTO|null Related employee */
    public ?EmployeesDTO $employee;

    /**
     * Create a new PayrollDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Payroll $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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

    /**
     * Create DTO from plain array data.
     *
     * @param array $data Associative array with DTO properties
     * @return self New DTO instance
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Convert DTO to array representation.
     *
     * @return array Array with snake_case keys matching database columns
     */
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

    /**
     * Convert DTO to array for Eloquent model creation/update.
     *
     * Returns fillable attributes only, excluding timestamps
     * and foreign keys for related models.
     *
     * @return array Associative array for model mass assignment
     */
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
