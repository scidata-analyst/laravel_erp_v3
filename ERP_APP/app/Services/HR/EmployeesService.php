<?php

namespace App\Services\HR;

use App\Interfaces\HR\EmployeesInterface;
use App\DTOs\HR\EmployeesDTO;
use App\Models\HR\Employees;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EmployeesService
{
    public function __construct(
        protected EmployeesInterface $repository
    ) {}

    public function getEmployees(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createEmployee(EmployeesDTO $dto): Employees
    {
        return $this->repository->create($dto->toArray());
    }

    public function getEmployeeById(int $id): ?Employees
    {
        return $this->repository->read($id);
    }

    public function updateEmployee(int $id, EmployeesDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteEmployee(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getEmployeesByDepartment(string $department): Collection
    {
        return $this->repository->getByDepartment($department);
    }
}
