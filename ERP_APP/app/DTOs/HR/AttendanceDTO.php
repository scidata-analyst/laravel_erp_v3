<?php

namespace App\DTOs\HR;

use App\Models\HR\Attendance;

class AttendanceDTO
{
    public ?int $id;

    public ?int $employeeId;

    public ?string $attendanceDate;

    public ?string $checkInTime;

    public ?string $checkOutTime;

    public ?int $status;

    public ?string $leaveType;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?EmployeesDTO $employee;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->employeeId = isset($data['employee_id']) ? (int) $data['employee_id'] : null;
        $this->attendanceDate = $data['attendance_date'] ?? null;
        $this->checkInTime = $data['check_in_time'] ?? null;
        $this->checkOutTime = $data['check_out_time'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->leaveType = $data['leave_type'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->employee = $data['employee'] ?? null;
    }

    public static function fromModel(Attendance $model): self
    {
        $data = [
            'id' => $model->id,
            'employee_id' => $model->employee_id,
            'attendance_date' => $model->attendance_date,
            'check_in_time' => $model->check_in_time,
            'check_out_time' => $model->check_out_time,
            'status' => $model->status,
            'leave_type' => $model->leave_type,
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
            'attendance_date' => $this->attendanceDate,
            'check_in_time' => $this->checkInTime,
            'check_out_time' => $this->checkOutTime,
            'status' => $this->status,
            'leave_type' => $this->leaveType,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'employee_id' => $this->employeeId,
            'attendance_date' => $this->attendanceDate,
            'check_in_time' => $this->checkInTime,
            'check_out_time' => $this->checkOutTime,
            'status' => $this->status,
            'leave_type' => $this->leaveType,
        ];
    }
}
