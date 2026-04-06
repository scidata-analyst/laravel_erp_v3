<?php

namespace App\Repositories\Purchase;

use App\Models\Purchase\PurchaseOrders;

class PurchaseOrdersRepository
{
    public function all()
    {
        return PurchaseOrders::query()->get();
    }

    public function find(int $id)
    {
        return PurchaseOrders::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return PurchaseOrders::query()->create($data);
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
