<?php

namespace App\DTOs\Ecommerce;

final class InvSyncDTO
{
    public readonly ?int $terminalId;
    public readonly int $channelId;
    public readonly string $syncType;
    public readonly ?int $recordsSynced;
    public readonly ?string $startedAt;
    public readonly ?string $completedAt;
    public readonly ?string $productSku;
    public readonly ?float $onlineQuantity;
    public readonly ?float $localQuantity;
    public readonly ?string $syncDate;
    public readonly ?string $status;

    public function __construct(array $data)
    {
        $this->terminalId = isset($data['terminal_id']) ? (int)$data['terminal_id'] : null;
        $this->channelId = (int)($data['channel_id'] ?? 0);
        $this->syncType = (string)($data['sync_type'] ?? 'Full');
        $this->recordsSynced = isset($data['records_synced']) ? (int)$data['records_synced'] : null;
        $this->startedAt = $data['started_at'] ?? $data['sync_date'] ?? null;
        $this->completedAt = $data['completed_at'] ?? null;
        $this->productSku = $data['product_sku'] ?? (isset($data['product_id']) ? (string)$data['product_id'] : null);
        $this->onlineQuantity = isset($data['online_quantity']) ? (float)$data['online_quantity'] : (isset($data['quantity']) ? (float)$data['quantity'] : null);
        $this->localQuantity = isset($data['local_quantity']) ? (float)$data['local_quantity'] : null;
        $this->syncDate = $data['sync_date'] ?? $data['started_at'] ?? null;
        $this->status = $data['status'] ?? 'Pending';
    }
}