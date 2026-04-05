<?php

namespace App\Repositories\Ecommerce;

use App\Interfaces\Ecommerce\InvSyncInterface;
use App\Models\Ecommerce\InvSync;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class InvSyncRepository implements InvSyncInterface
{
    public function all(): Collection
    {
        return InvSync::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return InvSync::with(['product', 'channel', 'terminal'])->paginate($perPage);
    }

    public function create(array $data): InvSync
    {
        return InvSync::create($data);
    }

    public function read(int $id): ?InvSync
    {
        return InvSync::with(['product', 'channel', 'terminal'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $sync = $this->read($id);
        return $sync ? $sync->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $sync = $this->read($id);
        return $sync ? $sync->delete() : false;
    }

    public function getByChannel(int $channelId): Collection
    {
        return InvSync::where('channel_id', $channelId)->get();
    }

    public function updateSyncStatus(int $id, string $status): bool
    {
        $sync = $this->read($id);
        if (!$sync) return false;

        $updateData = ['status' => $status];
        if ($status === 'Completed') {
            $updateData['completed_at'] = now()->toDateTimeString();
            $updateData['sync_date'] = $sync->sync_date ?? now()->toDateTimeString();
        }

        return $sync->update($updateData);
    }
}
