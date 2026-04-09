<?php

namespace App\DTOs\HR;

use App\Models\HR\Employees;

class EmployeesDTO
{
    public ?int $id;

    public ?string $fullName;

    public ?string $employeeId;

    public ?string $designation;

    public ?string $department;

    public ?float $basicSalary;

    public ?string $joinDate;

    public ?string $contractType;

    public ?string $email;

    public ?string $phone;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?array $attendanceRecords;

    public ?array $payrollRecords;

    public ?array $performanceReviews;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
