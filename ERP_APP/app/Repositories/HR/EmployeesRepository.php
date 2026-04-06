<?php

namespace App\Repositories\HR;

use App\Models\HR\Employees;

class EmployeesRepository
{
    public function all()
    {
        return Employees::query()->get();
    }

    public function find(int $id)
    {
        return Employees::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Employees::query()->create($data);
    }

    public function update(int $id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);

        return $record->refresh();
    }

    public function delete(int $id): bool
    {
        return (bool) $this->find($id)->delete();
    }
}
