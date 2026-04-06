<?php

namespace App\Repositories\UsersRoles;

use App\Models\UsersRoles\User;

class UserRepository
{
    public function all()
    {
        return User::query()->get();
    }

    public function find(int $id)
    {
        return User::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return User::query()->create($data);
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
