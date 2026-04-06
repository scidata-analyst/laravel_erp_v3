<?php

namespace App\Repositories\Projects;

use App\Models\Projects\Tasks;

class TasksRepository
{
    public function all()
    {
        return Tasks::query()->get();
    }

    public function find(int $id)
    {
        return Tasks::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Tasks::query()->create($data);
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
