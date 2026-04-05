<?php

namespace App\Services\HR;

use App\Interfaces\HR\AttendanceInterface;
use App\DTOs\HR\AttendanceDTO;
use App\Models\HR\Attendance;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AttendanceService
{
    public function __construct(
        protected AttendanceInterface $repository
    ) {}

    public function getAttendanceRecords(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function recordAttendance(AttendanceDTO $dto): Attendance
    {
        return $this->repository->create($dto->toArray());
    }

    public function checkIn(int $employeeId): Attendance
    {
        $data = [
            'employee_id' => $employeeId,
            'date' => now()->toDateString(),
            'check_in' => now()->toTimeString(),
            'status' => 'present'
        ];
        return $this->repository->create($data);
    }

    public function checkOut(int $employeeId): bool
    {
        $attendance = Attendance::where('employee_id', $employeeId)
            ->where('date', now()->toDateString())
            ->first();

        if (!$attendance) {
            throw new \Exception('Check-in record not found for today');
        }

        return $attendance->update(['check_out' => now()->toTimeString()]);
    }

    public function getEmployeeAttendance(int $employeeId): Collection
    {
        return $this->repository->getByEmployee($employeeId);
    }

    public function getAttendanceById(int $id): ?Attendance
    {
        return $this->repository->read($id);
    }

    public function updateAttendance(int $id, AttendanceDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteAttendance(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
