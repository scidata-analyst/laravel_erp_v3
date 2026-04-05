<?php

namespace App\Repositories\Inventory;

use App\Interfaces\Inventory\BatchTrackingInterface;
use App\Models\Inventory\BatchTracking;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BatchTrackingRepository implements BatchTrackingInterface
{
    public function all(): Collection
    {
        return BatchTracking::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return BatchTracking::with(['product'])->paginate($perPage);
    }

    public function create(array $data): BatchTracking
    {
        return BatchTracking::create($data);
    }

    public function read(int $id): ?BatchTracking
    {
        return BatchTracking::with(['product'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $batch = $this->read($id);
        return $batch ? $batch->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $batch = $this->read($id);
        return $batch ? $batch->delete() : false;
    }

    public function findByBatchNumber(string $batchNumber): ?BatchTracking
    {
        return BatchTracking::where('batch_number', $batchNumber)->first();
    }
}