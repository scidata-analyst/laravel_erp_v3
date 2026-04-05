<?php

namespace App\DTOs\Ecommerce;

class OnlineChannelsDTO
{
    public function __construct(
        public readonly string $channel_name,
        public readonly string $platform,
        public readonly ?string $api_endpoint = null,
        public readonly ?string $api_key = null,
        public readonly ?string $status = 'Active',
        public readonly ?string $last_sync_date = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            channel_name: $data['channel_name'] ?? $data['name'],
            platform: $data['platform'] ?? $data['channel_type'],
            api_endpoint: $data['api_endpoint'] ?? null,
            api_key: $data['api_key'] ?? null,
            status: $data['status'] ?? 'Active',
            last_sync_date: $data['last_sync_date'] ?? $data['last_sync'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'channel_name' => $this->channel_name,
            'platform' => $this->platform,
            'api_endpoint' => $this->api_endpoint,
            'api_key' => $this->api_key,
            'status' => $this->status,
            'last_sync_date' => $this->last_sync_date,
        ];
    }
}
