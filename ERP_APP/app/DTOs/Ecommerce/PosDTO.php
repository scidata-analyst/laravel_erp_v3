<?php

namespace App\DTOs\Ecommerce;

class PosDTO
{
    public function __construct(
        public readonly string $terminal_name,
        public readonly ?string $location = null,
        public readonly ?string $store_code = null,
        public readonly ?string $device_id = null,
        public readonly ?float $cash_drawer_balance = null,
        public readonly ?string $session_status = null,
        public readonly ?int $current_user_id = null,
        public readonly ?string $last_sync_date = null,
        public readonly ?bool $offline_mode = null,
        public readonly ?array $configuration = null,
        public readonly ?string $status = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            terminal_name: $data['terminal_name'],
            location: $data['location'] ?? null,
            store_code: $data['store_code'] ?? null,
            device_id: $data['device_id'] ?? null,
            cash_drawer_balance: isset($data['cash_drawer_balance']) ? (float) $data['cash_drawer_balance'] : null,
            session_status: $data['session_status'] ?? null,
            current_user_id: isset($data['current_user_id']) ? (int) $data['current_user_id'] : null,
            last_sync_date: $data['last_sync_date'] ?? $data['last_sync'] ?? null,
            offline_mode: isset($data['offline_mode']) ? (bool) $data['offline_mode'] : null,
            configuration: $data['configuration'] ?? null,
            status: $data['status'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'terminal_name' => $this->terminal_name,
            'location' => $this->location,
            'store_code' => $this->store_code,
            'device_id' => $this->device_id,
            'cash_drawer_balance' => $this->cash_drawer_balance,
            'session_status' => $this->session_status,
            'current_user_id' => $this->current_user_id,
            'last_sync_date' => $this->last_sync_date,
            'offline_mode' => $this->offline_mode,
            'configuration' => $this->configuration,
            'status' => $this->status,
        ];
    }
}
