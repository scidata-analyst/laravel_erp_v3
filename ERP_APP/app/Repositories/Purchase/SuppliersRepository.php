<?php

namespace App\Repositories\Purchase;

use App\Models\Purchase\Suppliers;

class SuppliersRepository
{
    public function all()
    {
        return Suppliers::query()->get();
    }

    public function find(int $id)
    {
        return Suppliers::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Suppliers::query()->create($data);
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
