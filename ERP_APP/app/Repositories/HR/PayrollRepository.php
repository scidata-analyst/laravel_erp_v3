<?php

namespace App\Repositories\HR;

use App\Models\HR\Payroll;

class PayrollRepository
{
    public function all()
    {
        return Payroll::query()->get();
    }

    public function find(int $id)
    {
        return Payroll::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Payroll::query()->create($data);
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
