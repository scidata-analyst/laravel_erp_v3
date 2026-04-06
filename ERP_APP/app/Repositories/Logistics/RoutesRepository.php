<?php

namespace App\Repositories\Logistics;

use App\Models\Logistics\Routes;

class RoutesRepository
{
    public function all()
    {
        return Routes::query()->get();
    }

    public function find(int $id)
    {
        return Routes::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Routes::query()->create($data);
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
