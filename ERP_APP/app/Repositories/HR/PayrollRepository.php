<?php

namespace App\Repositories\HR;

use App\Interfaces\HR\PayrollInterface;
use App\Models\HR\Payroll;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PayrollRepository implements PayrollInterface
{
    public function all(): Collection
    {
        return Payroll::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Payroll::with(['employee'])->paginate($perPage);
    }

    public function create(array $data): Payroll
    {
        return Payroll::create($data);
    }

    public function read(int $id): ?Payroll
    {
        return Payroll::with(['employee'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $payroll = $this->read($id);
        return $payroll ? $payroll->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $payroll = $this->read($id);
        return $payroll ? $payroll->delete() : false;
    }

    public function getByEmployee(int $employeeId): Collection
    {
        return Payroll::where('employee_id', $employeeId)->get();
    }
}