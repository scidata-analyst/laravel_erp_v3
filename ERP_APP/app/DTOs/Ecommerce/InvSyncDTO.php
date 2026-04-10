<?php

namespace App\DTOs\Ecommerce;

use App\Models\Ecommerce\InvSync;

/**
 * Data Transfer Object for InvSync entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates inventory synchronization data.
 *
 * @property int|null $id
 * @property int|null $channelId
 * @property string|null $lastSyncTime
 * @property int|null $totalSyncedItems
 * @property string|null $syncErrors
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 * @property OnlineChannelsDTO|null $channel
 */
class InvSyncDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var int|null Foreign key to online_channels table */
    public ?int $channelId;

    /** @var string|null Last synchronization timestamp (ISO 8601) */
    public ?string $lastSyncTime;

    /** @var int|null Total number of items synced */
    public ?int $totalSyncedItems;

    /** @var string|null Any sync errors encountered */
    public ?string $syncErrors;

    /** @var int|null Status: 0=Pending, 1=InProgress, 2=Completed, 3=Failed */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /** @var OnlineChannelsDTO|null Related online channel */
    public ?OnlineChannelsDTO $channel;

    /**
     * Create a new InvSyncDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param InvSync $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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

    /**
     * Create DTO from plain array data.
     *
     * @param array $data Associative array with DTO properties
     * @return self New DTO instance
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Convert DTO to array representation.
     *
     * @return array Array with snake_case keys matching database columns
     */
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

    /**
     * Convert DTO to array for Eloquent model creation/update.
     *
     * Returns fillable attributes only, excluding timestamps
     * and foreign keys for related models.
     *
     * @return array Associative array for model mass assignment
     */
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
