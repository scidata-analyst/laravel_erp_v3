<?php

namespace App\Repositories\Core;

use App\Interfaces\Core\SettingsInterface;
use App\Models\Core\Settings;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SettingsRepository implements SettingsInterface
{
    public function all(): Collection
    {
        return Settings::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Settings::paginate($perPage);
    }

    public function create(array $data): Settings
    {
        return Settings::create($data);
    }

    public function read(int $id): ?Settings
    {
        return Settings::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $setting = $this->read($id);
        return $setting ? $setting->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $setting = $this->read($id);
        return $setting ? $setting->delete() : false;
    }

    public function getByKey(string $key): ?Settings
    {
        return Settings::where('setting_key', $key)->first();
    }

    public function getByCategory(string $category): Collection
    {
        return Settings::where('category', $category)->get();
    }
}