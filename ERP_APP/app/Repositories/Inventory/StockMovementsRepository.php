<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StockMovements;

class StockMovementsRepository
{
    public function all()
    {
        return StockMovements::query()->get();
    }

    public function find(int $id)
    {
        return StockMovements::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return StockMovements::query()->create($data);
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
