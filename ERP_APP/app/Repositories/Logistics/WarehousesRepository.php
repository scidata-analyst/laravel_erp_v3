<?php

namespace App\Repositories\Logistics;

use App\Models\Logistics\Warehouses;

class WarehousesRepository
{
    public function all()
    {
        return Warehouses::query()->get();
    }

    public function find(int $id)
    {
        return Warehouses::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Warehouses::query()->create($data);
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
