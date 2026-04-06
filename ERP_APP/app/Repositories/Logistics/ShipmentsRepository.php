<?php

namespace App\Repositories\Logistics;

use App\Models\Logistics\Shipments;

class ShipmentsRepository
{
    public function all()
    {
        return Shipments::query()->get();
    }

    public function find(int $id)
    {
        return Shipments::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Shipments::query()->create($data);
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
