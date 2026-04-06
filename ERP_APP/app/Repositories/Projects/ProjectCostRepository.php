<?php

namespace App\Repositories\Projects;

use App\Models\Projects\ProjectCost;

class ProjectCostRepository
{
    public function all()
    {
        return ProjectCost::query()->get();
    }

    public function find(int $id)
    {
        return ProjectCost::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return ProjectCost::query()->create($data);
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
