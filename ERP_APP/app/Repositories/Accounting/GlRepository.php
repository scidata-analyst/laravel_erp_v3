<?php

namespace App\Repositories\Accounting;

use App\Models\Accounting\Gl;

class GlRepository
{
    public function all()
    {
        return Gl::query()->get();
    }

    public function find(int $id)
    {
        return Gl::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Gl::query()->create($data);
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
