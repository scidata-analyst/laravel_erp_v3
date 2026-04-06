<?php

namespace App\Repositories\Sales;

use App\Models\Sales\SalesOrders;

class SalesOrdersRepository
{
    public function all()
    {
        return SalesOrders::query()->get();
    }

    public function find(int $id)
    {
        return SalesOrders::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return SalesOrders::query()->create($data);
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
