<?php

namespace App\Repositories\Core;

use App\Models\Core\Dashboard;

class DashboardRepository
{
    public function all()
    {
        return Dashboard::query()->get();
    }

    public function find(int $id)
    {
        return Dashboard::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Dashboard::query()->create($data);
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
