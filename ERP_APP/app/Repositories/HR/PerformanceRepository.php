<?php

namespace App\Repositories\HR;

use App\Interfaces\HR\PerformanceInterface;
use App\Models\HR\Performance;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PerformanceRepository implements PerformanceInterface
{
    public function all(): Collection
    {
        return Performance::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Performance::with(['employee'])->paginate($perPage);
    }

    public function create(array $data): Performance
    {
        return Performance::create($data);
    }

    public function read(int $id): ?Performance
    {
        return Performance::with(['employee'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $performance = $this->read($id);
        return $performance ? $performance->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $performance = $this->read($id);
        return $performance ? $performance->delete() : false;
    }

    public function getByEmployee(int $employeeId): Collection
    {
        return Performance::where('employee_id', $employeeId)->get();
    }
}