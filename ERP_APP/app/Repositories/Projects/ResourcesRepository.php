<?php

namespace App\Repositories\Projects;

use App\Models\Projects\Resources;

class ResourcesRepository
{
    public function all()
    {
        return Resources::query()->get();
    }

    public function find(int $id)
    {
        return Resources::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Resources::query()->create($data);
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
