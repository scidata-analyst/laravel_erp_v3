<?php

namespace App\Repositories\Accounting;

use App\Models\Accounting\ApAr;

class ApArRepository
{
    public function all()
    {
        return ApAr::query()->get();
    }

    public function find(int $id)
    {
        return ApAr::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return ApAr::query()->create($data);
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
