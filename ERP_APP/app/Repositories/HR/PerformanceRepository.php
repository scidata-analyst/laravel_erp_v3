<?php

namespace App\Repositories\HR;

use App\Models\HR\Performance;

class PerformanceRepository
{
    public function all()
    {
        return Performance::query()->get();
    }

    public function find(int $id)
    {
        return Performance::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Performance::query()->create($data);
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
