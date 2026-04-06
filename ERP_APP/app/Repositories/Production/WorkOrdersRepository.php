<?php

namespace App\Repositories\Production;

use App\Models\Production\WorkOrders;

class WorkOrdersRepository
{
    public function all()
    {
        return WorkOrders::query()->get();
    }

    public function find(int $id)
    {
        return WorkOrders::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return WorkOrders::query()->create($data);
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
