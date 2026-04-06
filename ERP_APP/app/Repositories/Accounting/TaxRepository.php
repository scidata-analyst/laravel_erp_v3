<?php

namespace App\Repositories\Accounting;

use App\Models\Accounting\Tax;

class TaxRepository
{
    public function all()
    {
        return Tax::query()->get();
    }

    public function find(int $id)
    {
        return Tax::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Tax::query()->create($data);
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
