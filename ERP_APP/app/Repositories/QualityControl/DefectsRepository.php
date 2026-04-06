<?php

namespace App\Repositories\QualityControl;

use App\Models\QualityControl\Defects;

class DefectsRepository
{
    public function all()
    {
        return Defects::query()->get();
    }

    public function find(int $id)
    {
        return Defects::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Defects::query()->create($data);
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
