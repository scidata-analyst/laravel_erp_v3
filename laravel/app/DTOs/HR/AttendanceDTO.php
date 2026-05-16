<?php

namespace App\DTOs\HR;

use App\Models\HR\Attendance;

/**
 * Data Transfer Object for Attendance entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates employee attendance data.
 *
 * @property int|null $id
 * @property int|null $employeeId
 * @property string|null $attendanceDate
 * @property string|null $checkInTime
 * @property string|null $checkOutTime
 * @property int|null $status
 * @property string|null $leaveType
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property EmployeesDTO|null $employee
 */
class AttendanceDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to employees table */
    public ?int $employeeId;

    /** @var string|null Date of attendance (Y-m-d) */
    public ?string $attendanceDate;

    /** @var string|null Check-in time (H:i:s) */
    public ?string $checkInTime;

    /** @var string|null Check-out time (H:i:s) */
    public ?string $checkOutTime;

    /** @var int|null Status: 0=Absent, 1=Present, 2=Late, 3=OnLeave */
    public ?int $status;

    /** @var string|null Type of leave if applicable (e.g., 'Sick', 'Casual', 'Annual') */
    public ?string $leaveType;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var EmployeesDTO|null Related employee */
    public ?EmployeesDTO $employee;

    /**
     * Create a new AttendanceDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param Attendance $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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
            'attendance_date' => $this->attendanceDate,
            'check_in_time' => $this->checkInTime,
            'check_out_time' => $this->checkOutTime,
            'status' => $this->status,
            'leave_type' => $this->leaveType,
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
            'attendance_date' => $this->attendanceDate,
            'check_in_time' => $this->checkInTime,
            'check_out_time' => $this->checkOutTime,
            'status' => $this->status,
            'leave_type' => $this->leaveType,
        ];
    }
}
