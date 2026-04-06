<?php

namespace App\Repositories\QualityControl;

use App\Models\QualityControl\Compliance;

class ComplianceRepository
{
    public function all()
    {
        return Compliance::query()->get();
    }

    public function find(int $id)
    {
        return Compliance::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Compliance::query()->create($data);
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
