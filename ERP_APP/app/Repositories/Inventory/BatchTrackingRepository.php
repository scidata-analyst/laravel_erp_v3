<?php

namespace App\Repositories\Inventory;

use App\Models\Inventory\BatchTracking;

class BatchTrackingRepository
{
    public function all()
    {
        return BatchTracking::query()->get();
    }

    public function find(int $id)
    {
        return BatchTracking::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return BatchTracking::query()->create($data);
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
