<?php

namespace App\Repositories\Reports;

use App\Models\Reports\BiDashboards;

class BiDashboardsRepository
{
    public function all()
    {
        return BiDashboards::query()->get();
    }

    public function find(int $id)
    {
        return BiDashboards::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return BiDashboards::query()->create($data);
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
