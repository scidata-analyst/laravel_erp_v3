<?php

namespace App\Repositories\CRM;

use App\Models\CRM\Support;

class SupportRepository
{
    public function all()
    {
        return Support::query()->get();
    }

    public function find(int $id)
    {
        return Support::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Support::query()->create($data);
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
