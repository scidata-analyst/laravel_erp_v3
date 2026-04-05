<?php

namespace App\DTOs\Ecommerce;

class InvSyncDTO
{
    public function __construct(
        public readonly ?int $terminal_id = null,
        public readonly int $channel_id,
        public readonly string $sync_type,
        public readonly ?int $records_synced = null,
        public readonly ?string $started_at = null,
        public readonly ?string $completed_at = null,
        public readonly ?string $product_sku = null,
        public readonly ?float $online_quantity = null,
        public readonly ?float $local_quantity = null,
        public readonly ?string $sync_date = null,
        public readonly ?string $status = 'Pending',
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            terminal_id: isset($data['terminal_id']) ? (int) $data['terminal_id'] : null,
            channel_id: (int) $data['channel_id'],
            sync_type: $data['sync_type'] ?? 'Full',
            records_synced: isset($data['records_synced']) ? (int) $data['records_synced'] : null,
            started_at: $data['started_at'] ?? $data['sync_date'] ?? null,
            completed_at: $data['completed_at'] ?? null,
            product_sku: $data['product_sku'] ?? (isset($data['product_id']) ? (string) $data['product_id'] : null),
            online_quantity: isset($data['online_quantity']) ? (float) $data['online_quantity'] : (isset($data['quantity']) ? (float) $data['quantity'] : null),
            local_quantity: isset($data['local_quantity']) ? (float) $data['local_quantity'] : null,
            sync_date: $data['sync_date'] ?? $data['started_at'] ?? null,
            status: $data['status'] ?? 'Pending',
        );
    }

    public function toArray(): array
    {
        return [
            'terminal_id' => $this->terminal_id,
            'channel_id' => $this->channel_id,
            'sync_type' => $this->sync_type,
            'records_synced' => $this->records_synced,
            'started_at' => $this->started_at,
            'completed_at' => $this->completed_at,
            'product_sku' => $this->product_sku,
            'online_quantity' => $this->online_quantity,
            'local_quantity' => $this->local_quantity,
            'sync_date' => $this->sync_date,
            'status' => $this->status,
        ];
    }
}
