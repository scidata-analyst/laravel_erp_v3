<?php

namespace App\Repositories\HR;

use App\Interfaces\HR\EmployeesInterface;
use App\Models\HR\Employees;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EmployeesRepository implements EmployeesInterface
{
    public function all(): Collection
    {
        return Employees::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Employees::paginate($perPage);
    }

    public function create(array $data): Employees
    {
        return Employees::create($data);
    }

    public function read(int $id): ?Employees
    {
        return Employees::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $employee = $this->read($id);
        return $employee ? $employee->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $employee = $this->read($id);
        return $employee ? $employee->delete() : false;
    }

    public function getByDepartment(string $department): Collection
    {
        return Employees::where('department', $department)->get();
    }
}