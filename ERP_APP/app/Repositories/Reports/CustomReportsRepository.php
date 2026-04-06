<?php

namespace App\Repositories\Reports;

use App\Models\Reports\CustomReports;

class CustomReportsRepository
{
    public function all()
    {
        return CustomReports::query()->get();
    }

    public function find(int $id)
    {
        return CustomReports::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return CustomReports::query()->create($data);
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
