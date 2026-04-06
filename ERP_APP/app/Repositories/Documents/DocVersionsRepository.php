<?php

namespace App\Repositories\Documents;

use App\Models\Documents\DocVersions;

class DocVersionsRepository
{
    public function all()
    {
        return DocVersions::query()->get();
    }

    public function find(int $id)
    {
        return DocVersions::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return DocVersions::query()->create($data);
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
