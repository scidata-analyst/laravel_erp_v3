<?php

namespace App\Repositories\UsersRoles;

use App\Models\UsersRoles\Roles;

class RolesRepository
{
    public function all()
    {
        return Roles::query()->get();
    }

    public function find(int $id)
    {
        return Roles::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Roles::query()->create($data);
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
