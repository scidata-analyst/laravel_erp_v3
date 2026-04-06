<?php

namespace App\DTOs\Ecommerce;

class InvSyncDTO
{
    public readonly ?int $terminal_id;
    public readonly int $channel_id;
    public readonly string $sync_type;
    public readonly ?int $records_synced;
    public readonly ?string $started_at;
    public readonly ?string $completed_at;
    public readonly ?string $product_sku;
    public readonly ?float $online_quantity;
    public readonly ?float $local_quantity;
    public readonly ?string $sync_date;
    public readonly ?string $status;

    public function __construct(array $data)
    {
        $this->terminal_id = isset($data['terminal_id']) ? (int) $data['terminal_id'] : null;
        $this->channel_id = (int) $data['channel_id'];
        $this->sync_type = $data['sync_type'] ?? 'Full';
        $this->records_synced = isset($data['records_synced']) ? (int) $data['records_synced'] : null;
        $this->started_at = $data['started_at'] ?? $data['sync_date'] ?? null;
        $this->completed_at = $data['completed_at'] ?? null;
        $this->product_sku = $data['product_sku'] ?? (isset($data['product_id']) ? (string) $data['product_id'] : null);
        $this->online_quantity = isset($data['online_quantity']) ? (float) $data['online_quantity'] : (isset($data['quantity']) ? (float) $data['quantity'] : null);
        $this->local_quantity = isset($data['local_quantity']) ? (float) $data['local_quantity'] : null;
        $this->sync_date = $data['sync_date'] ?? $data['started_at'] ?? null;
        $this->status = $data['status'] ?? 'Pending';
    }
}