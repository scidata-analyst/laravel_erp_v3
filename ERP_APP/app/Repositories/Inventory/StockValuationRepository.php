<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\StockValuation;

class StockValuationRepository
{
    public function all()
    {
        return StockValuation::query()->get();
    }

    public function find(int $id)
    {
        return StockValuation::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return StockValuation::query()->create($data);
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
