<?php

namespace App\Services\Ecommerce;

use App\Interfaces\Ecommerce\InvSyncInterface;
use App\DTOs\Ecommerce\InvSyncDTO;
use App\Models\Ecommerce\InvSync;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class InvSyncService
{
    public function __construct(
        protected InvSyncInterface $repository
    ) {}

    public function getSyncLogs(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function initiateSync(InvSyncDTO $dto): InvSync
    {
        return $this->repository->create($dto->toArray());
    }

    public function getSyncById(int $id): ?InvSync
    {
        return $this->repository->read($id);
    }

    public function updateSync(int $id, InvSyncDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteSync(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getSyncsByChannel(int $channelId): Collection
    {
        return $this->repository->getByChannel($channelId);
    }

    public function markSyncCompleted(int $id): bool
    {
        return $this->repository->updateSyncStatus($id, 'Completed');
    }
}
