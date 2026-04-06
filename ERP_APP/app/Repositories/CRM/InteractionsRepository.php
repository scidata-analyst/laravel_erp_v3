<?php

namespace App\Repositories\CRM;

use App\Models\CRM\Interactions;

class InteractionsRepository
{
    public function all()
    {
        return Interactions::query()->get();
    }

    public function find(int $id)
    {
        return Interactions::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Interactions::query()->create($data);
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
