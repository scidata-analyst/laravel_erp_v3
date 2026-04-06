<?php

namespace App\Repositories\Sales;

use App\Models\Sales\Customers;

class CustomersRepository
{
    public function all()
    {
        return Customers::query()->get();
    }

    public function find(int $id)
    {
        return Customers::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Customers::query()->create($data);
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
