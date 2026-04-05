<?php

namespace App\Repositories\HR;

use App\Interfaces\HR\AttendanceInterface;
use App\Models\HR\Attendance;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AttendanceRepository implements AttendanceInterface
{
    public function all(): Collection
    {
        return Attendance::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Attendance::with(['employee'])->paginate($perPage);
    }

    public function create(array $data): Attendance
    {
        return Attendance::create($data);
    }

    public function read(int $id): ?Attendance
    {
        return Attendance::with(['employee'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $attendance = $this->read($id);
        return $attendance ? $attendance->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $attendance = $this->read($id);
        return $attendance ? $attendance->delete() : false;
    }

    public function getByEmployee(int $employeeId): Collection
    {
        return Attendance::where('employee_id', $employeeId)->get();
    }

    public function getByDate(string $date): Collection
    {
        return Attendance::where('date', $date)->get();
    }
}