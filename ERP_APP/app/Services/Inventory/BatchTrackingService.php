<?php

namespace App\Services\Inventory;

use App\Interfaces\Inventory\BatchTrackingInterface;
use App\DTOs\Inventory\BatchTrackingDTO;
use App\Models\Inventory\BatchTracking;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BatchTrackingService
{
    public function __construct(
        protected BatchTrackingInterface $repository
    ) {}

    public function getBatches(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createBatch(BatchTrackingDTO $dto): BatchTracking
    {
        return $this->repository->create($dto->toArray());
    }

    public function getBatchById(int $id): ?BatchTracking
    {
        return $this->repository->read($id);
    }

    public function updateBatch(int $id, BatchTrackingDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteBatch(int $id): bool
    {
        $batch = $this->repository->read($id);
        if (!$batch) {
            throw new \Exception('Batch not found');
        }

        if ($batch->current_quantity > 0) {
            throw new \Exception('Cannot delete batch with remaining quantity');
        }

        return $this->repository->delete($id);
    }

    public function getExpiringBatches(int $days = 30): Collection
    {
        return BatchTracking::where('expiry_date', '<=', now()->addDays($days))
            ->where('current_quantity', '>', 0)
            ->with(['product'])
            ->get();
    }
}
