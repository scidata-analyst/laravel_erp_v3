<?php

namespace App\Repositories\Core;

use App\Models\Core\Settings;

class SettingsRepository
{
    public function all()
    {
        return Settings::query()->get();
    }

    public function find(int $id)
    {
        return Settings::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Settings::query()->create($data);
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
