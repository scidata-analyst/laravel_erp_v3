<?php

namespace App\Repositories\Production;

use App\Models\Production\Bom;

class BomRepository
{
    public function all()
    {
        return Bom::query()->get();
    }

    public function find(int $id)
    {
        return Bom::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Bom::query()->create($data);
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
