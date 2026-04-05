<?php

namespace App\Services\Core;

use App\Interfaces\Core\SettingsInterface;
use App\DTOs\Core\SettingsDTO;
use App\Models\Core\Settings;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SettingsService
{
    public function __construct(
        protected SettingsInterface $repository
    ) {}

    public function getSettings(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function saveSetting(SettingsDTO $dto): Settings
    {
        $existing = $this->repository->getByKey($dto->setting_key);
        if ($existing) {
            $this->repository->update($existing->id, $dto->toArray());
            return $existing->fresh();
        }
        return $this->repository->create($dto->toArray());
    }

    public function getSettingByKey(string $key): ?Settings
    {
        return $this->repository->getByKey($key);
    }

    public function getSettingsByCategory(string $category): Collection
    {
        return $this->repository->getByCategory($category);
    }

    public function deleteSetting(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
