<?php

namespace App\Repositories\Documents;

use App\Models\Documents\DocLibrary;

class DocLibraryRepository
{
    public function all()
    {
        return DocLibrary::query()->get();
    }

    public function find(int $id)
    {
        return DocLibrary::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return DocLibrary::query()->create($data);
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
