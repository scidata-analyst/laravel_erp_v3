<?php

namespace App\Repositories\QualityControl;

use App\Models\QualityControl\QcChecklists;

class QcChecklistsRepository
{
    public function all()
    {
        return QcChecklists::query()->get();
    }

    public function find(int $id)
    {
        return QcChecklists::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return QcChecklists::query()->create($data);
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
