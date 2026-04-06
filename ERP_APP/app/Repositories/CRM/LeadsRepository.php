<?php

namespace App\Repositories\CRM;

use App\Models\CRM\Leads;

class LeadsRepository
{
    public function all()
    {
        return Leads::query()->get();
    }

    public function find(int $id)
    {
        return Leads::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Leads::query()->create($data);
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
