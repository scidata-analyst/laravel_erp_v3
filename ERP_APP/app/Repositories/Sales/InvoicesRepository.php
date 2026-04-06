<?php

namespace App\Repositories\Sales;

use App\Models\Sales\Invoices;

class InvoicesRepository
{
    public function all()
    {
        return Invoices::query()->get();
    }

    public function find(int $id)
    {
        return Invoices::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Invoices::query()->create($data);
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
