<?php

namespace App\Repositories\Ecommerce;

use App\Models\Ecommerce\Pos;

class PosRepository
{
    public function all()
    {
        return Pos::query()->get();
    }

    public function find(int $id)
    {
        return Pos::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Pos::query()->create($data);
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
