<?php

namespace App\DTOs\Ecommerce;

class OnlineChannelsDTO
{
    public readonly string $channelName;
    public readonly string $platform;
    public readonly ?string $apiEndpoint;
    public readonly ?string $apiKey;
    public readonly ?string $status;
    public readonly ?string $lastSyncDate;

    public function __construct(array $data)
    {
        $this->channelName = (string)($data['channel_name'] ?? $data['name'] ?? '');
        $this->platform = (string)($data['platform'] ?? $data['channel_type'] ?? '');
        $this->apiEndpoint = $data['api_endpoint'] ?? null;
        $this->apiKey = $data['api_key'] ?? null;
        $this->status = $data['status'] ?? 'Active';
        $this->lastSyncDate = $data['last_sync_date'] ?? $data['last_sync'] ?? null;
    }
}