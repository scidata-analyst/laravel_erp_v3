<?php

namespace App\Services\HR;

use App\Interfaces\HR\PayrollInterface;
use App\DTOs\HR\PayrollDTO;
use App\Models\HR\Payroll;
use App\Models\HR\Employees;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PayrollService
{
    public function __construct(
        protected PayrollInterface $repository
    ) {}

    public function getPayrolls(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function processPayroll(PayrollDTO $dto): Payroll
    {
        return DB::transaction(function () use ($dto) {
            $payroll = $this->repository->create($dto->toArray());

            // Potentially trigger accounting entries here
            // e.g., GlService->recordDoubleEntry()
            
            return $payroll;
        });
    }

    public function generatePayrollForPeriod(string $start, string $end): array
    {
        $employees = Employees::where('status', 'active')->get();
        $payrolls = [];

        foreach ($employees as $employee) {
            // Complex calculation for each employee
            $payrollData = [
                'employee_id' => $employee->id,
                'period_start' => $start,
                'period_end' => $end,
                'basic_salary' => $employee->basic_salary,
                'allowances' => 0, // Should come from a SalaryComponents model
                'deductions' => 0,
                'net_salary' => $employee->basic_salary,
                'status' => 'draft'
            ];
            $payrolls[] = $this->repository->create($payrollData);
        }

        return $payrolls;
    }

    public function getPayrollById(int $id): ?Payroll
    {
        return $this->repository->read($id);
    }

    public function updatePayroll(int $id, PayrollDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deletePayroll(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
