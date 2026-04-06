<?php

namespace App\Repositories\Purchase;

use App\Models\Purchase\Grn;

class GrnRepository
{
    public function all()
    {
        return Grn::query()->get();
    }

    public function find(int $id)
    {
        return Grn::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Grn::query()->create($data);
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
