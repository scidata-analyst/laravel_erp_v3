<?php

namespace App\DTOs\Ecommerce;

use App\Models\Ecommerce\InvSync;

class InvSyncDTO
{
    public ?int $id;

    public ?int $channelId;

    public ?string $lastSyncTime;

    public ?int $totalSyncedItems;

    public ?string $syncErrors;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public ?OnlineChannelsDTO $channel;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->channelId = isset($data['channel_id']) ? (int) $data['channel_id'] : null;
        $this->lastSyncTime = $data['last_sync_time'] ?? null;
        $this->totalSyncedItems = isset($data['total_synced_items']) ? (int) $data['total_synced_items'] : null;
        $this->syncErrors = $data['sync_errors'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->channel = $data['channel'] ?? null;
    }

    public static function fromModel(InvSync $model): self
    {
        $data = [
            'id' => $model->id,
            'channel_id' => $model->channel_id,
            'last_sync_time' => $model->last_sync_time,
            'total_synced_items' => $model->total_synced_items,
            'sync_errors' => $model->sync_errors,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ];

        if ($model->relationLoaded('channel')) {
            $data['channel'] = OnlineChannelsDTO::fromModel($model->channel);
        }

        return new self($data);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'channel_id' => $this->channelId,
            'last_sync_time' => $this->lastSyncTime,
            'total_synced_items' => $this->totalSyncedItems,
            'sync_errors' => $this->syncErrors,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'channel_id' => $this->channelId,
            'last_sync_time' => $this->lastSyncTime,
            'total_synced_items' => $this->totalSyncedItems,
            'sync_errors' => $this->syncErrors,
            'status' => $this->status,
        ];
    }
}
