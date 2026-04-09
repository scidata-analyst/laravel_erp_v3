<?php

namespace App\DTOs\Ecommerce;

use App\Models\Ecommerce\OnlineChannels;

class OnlineChannelsDTO
{
    public ?int $id;

    public ?string $channelName;

    public ?string $platform;

    public ?string $apiStoreUrl;

    public ?string $apiKey;

    public ?string $syncFrequency;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->channelName = $data['channel_name'] ?? null;
        $this->platform = $data['platform'] ?? null;
        $this->apiStoreUrl = $data['api_store_url'] ?? null;
        $this->apiKey = $data['api_key'] ?? null;
        $this->syncFrequency = $data['sync_frequency'] ?? null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    public static function fromModel(OnlineChannels $model): self
    {
        return new self([
            'id' => $model->id,
            'channel_name' => $model->channel_name,
            'platform' => $model->platform,
            'api_store_url' => $model->api_store_url,
            'api_key' => $model->api_key,
            'sync_frequency' => $model->sync_frequency,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ]);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'channel_name' => $this->channelName,
            'platform' => $this->platform,
            'api_store_url' => $this->apiStoreUrl,
            'api_key' => $this->apiKey,
            'sync_frequency' => $this->syncFrequency,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'channel_name' => $this->channelName,
            'platform' => $this->platform,
            'api_store_url' => $this->apiStoreUrl,
            'api_key' => $this->apiKey,
            'sync_frequency' => $this->syncFrequency,
            'status' => $this->status,
        ];
    }
}
