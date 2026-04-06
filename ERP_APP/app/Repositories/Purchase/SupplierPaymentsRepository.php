<?php

namespace App\Repositories\Purchase;

use App\Models\Purchase\SupplierPayments;

class SupplierPaymentsRepository
{
    public function all()
    {
        return SupplierPayments::query()->get();
    }

    public function find(int $id)
    {
        return SupplierPayments::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return SupplierPayments::query()->create($data);
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
