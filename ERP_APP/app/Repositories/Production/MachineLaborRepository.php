<?php

namespace App\Repositories\Production;

use App\Models\Production\MachineLabor;

class MachineLaborRepository
{
    public function all()
    {
        return MachineLabor::query()->get();
    }

    public function find(int $id)
    {
        return MachineLabor::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return MachineLabor::query()->create($data);
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
