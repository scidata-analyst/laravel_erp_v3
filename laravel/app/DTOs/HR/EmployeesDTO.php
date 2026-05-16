<?php

namespace App\DTOs\HR;

use App\Models\HR\Employees;

/**
 * Data Transfer Object for Employees entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates employee data with relationships.
 *
 * @property int|null $id
 * @property string|null $fullName
 * @property string|null $employeeId
 * @property string|null $designation
 * @property string|null $department
 * @property float|null $basicSalary
 * @property string|null $joinDate
 * @property string|null $contractType
 * @property string|null $email
 * @property string|null $phone
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property array|null $attendanceRecords
 * @property array|null $payrollRecords
 * @property array|null $performanceReviews
 */
class EmployeesDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Full name of the employee */
    public ?string $fullName;

    /** @var string|null Unique employee identifier (e.g., 'EMP-001') */
    public ?string $employeeId;

    /** @var string|null Job title/position */
    public ?string $designation;

    /** @var string|null Department name */
    public ?string $department;

    /** @var float|null Base salary amount */
    public ?float $basicSalary;

    /** @var string|null Date of joining (Y-m-d) */
    public ?string $joinDate;

    /** @var string|null Contract type (e.g., 'Full-time', 'Part-time', 'Contract') */
    public ?string $contractType;

    /** @var string|null Email address */
    public ?string $email;

    /** @var string|null Phone number */
    public ?string $phone;

    /** @var int|null Status: 0=Inactive, 1=Active, 2=OnLeave, 3=Terminated */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var array|null Collection of related attendance records */
    public ?array $attendanceRecords;

    /** @var array|null Collection of related payroll records */
    public ?array $payrollRecords;

    /** @var array|null Collection of related performance reviews */
    public ?array $performanceReviews;

    /**
     * Create a new EmployeesDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->fullName = $data['full_name'] ?? null;
        $this->employeeId = $data['employee_id'] ?? null;
        $this->designation = $data['designation'] ?? null;
        $this->department = $data['department'] ?? null;
        $this->basicSalary = isset($data['basic_salary']) ? (float) $data['basic_salary'] : null;
        $this->joinDate = $data['join_date'] ?? null;
        $this->contractType = $data['contract_type'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->attendanceRecords = $data['attendanceRecords'] ?? null;
        $this->payrollRecords = $data['payrollRecords'] ?? null;
        $this->performanceReviews = $data['performanceReviews'] ?? null;
    }

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Employees $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
    public static function fromModel(Employees $model): self
    {
        $data = [
            'id' => $model->id,
            'full_name' => $model->full_name,
            'employee_id' => $model->employee_id,
            'designation' => $model->designation,
            'department' => $model->department,
            'basic_salary' => $model->basic_salary,
            'join_date' => $model->join_date,
            'contract_type' => $model->contract_type,
            'email' => $model->email,
            'phone' => $model->phone,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('attendanceRecords')) {
            $data['attendanceRecords'] = $model->attendanceRecords->map(fn ($a) => AttendanceDTO::fromModel($a))->all();
        }

        if ($model->relationLoaded('payrollRecords')) {
            $data['payrollRecords'] = $model->payrollRecords->map(fn ($p) => PayrollDTO::fromModel($p))->all();
        }

        if ($model->relationLoaded('performanceReviews')) {
            $data['performanceReviews'] = $model->performanceReviews->map(fn ($r) => PerformanceDTO::fromModel($r))->all();
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
            'full_name' => $this->fullName,
            'employee_id' => $this->employeeId,
            'designation' => $this->designation,
            'department' => $this->department,
            'basic_salary' => $this->basicSalary,
            'join_date' => $this->joinDate,
            'contract_type' => $this->contractType,
            'email' => $this->email,
            'phone' => $this->phone,
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
            'full_name' => $this->fullName,
            'employee_id' => $this->employeeId,
            'designation' => $this->designation,
            'department' => $this->department,
            'basic_salary' => $this->basicSalary,
            'join_date' => $this->joinDate,
            'contract_type' => $this->contractType,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
        ];
    }
}
