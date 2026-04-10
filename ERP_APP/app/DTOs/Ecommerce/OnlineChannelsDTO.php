<?php

namespace App\DTOs\Ecommerce;

use App\Models\Ecommerce\OnlineChannels;

/**
 * Data Transfer Object for OnlineChannels entity.
 *
 * Used for type-safe data transfer between layers
 * and encapsulates e-commerce channel/platform data.
 *
 * @property int|null $id
 * @property string|null $channelName
 * @property string|null $platform
 * @property string|null $apiStoreUrl
 * @property string|null $apiKey
 * @property string|null $syncFrequency
 * @property int|null $status
 * @property string|null $createdAt
 * @property string|null $updatedAt
 */
class OnlineChannelsDTO
{
    /** @var int|null Unique identifier */
    public ?int $id;

    /** @var string|null Name of the channel (e.g., 'Shopify Store', 'Amazon UK') */
    public ?string $channelName;

    /** @var string|null E-commerce platform (e.g., 'Shopify', 'WooCommerce', 'Amazon') */
    public ?string $platform;

    /** @var string|null API store URL */
    public ?string $apiStoreUrl;

    /** @var string|null API key for integration */
    public ?string $apiKey;

    /** @var string|null Sync frequency (e.g., 'Hourly', 'Daily', 'Manual') */
    public ?string $syncFrequency;

    /** @var int|null Status: 0=Inactive, 1=Active, 2=Suspended */
    public ?int $status;

    /** @var string|null Creation timestamp (ISO 8601) */
    public ?string $createdAt;

    /** @var string|null Last update timestamp (ISO 8601) */
    public ?string $updatedAt;

    /**
     * Create a new OnlineChannelsDTO instance.
     *
     * @param array $data Optional data array for initialization
     */
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

    /**
     * Create DTO from Eloquent model instance.
     *
     * @param OnlineChannels $model Eloquent model to convert
     * @return self New DTO instance with model data
     */
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
            'channel_name' => $this->channelName,
            'platform' => $this->platform,
            'api_store_url' => $this->apiStoreUrl,
            'api_key' => $this->apiKey,
            'sync_frequency' => $this->syncFrequency,
            'status' => $this->status,
        ];
    }
}
