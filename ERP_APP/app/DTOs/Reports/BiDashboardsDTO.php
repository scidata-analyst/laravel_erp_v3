<?php

namespace App\DTOs\Reports;

class BiDashboardsDTO
{
    public function __construct(
        public readonly string $dashboard_name,
        public readonly ?string $dashboard = null,
        public readonly array $widgets = [],
        public readonly ?array $layout_config = null,
        public readonly ?int $refresh_interval = null,
        public readonly ?string $description = null,
        public readonly ?string $status = 'Active',
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            dashboard_name: $data['dashboard_name'] ?? $data['name'] ?? $data['dashboard'],
            dashboard: $data['dashboard'] ?? null,
            widgets: $data['widgets'] ?? [],
            layout_config: $data['layout_config'] ?? $data['layout'] ?? null,
            refresh_interval: isset($data['refresh_interval']) ? (int) $data['refresh_interval'] : (isset($data['refresh_rate']) ? (int) $data['refresh_rate'] : null),
            description: $data['description'] ?? null,
            status: $data['status'] ?? 'Active',
        );
    }

    public function toArray(): array
    {
        return [
            'dashboard_name' => $this->dashboard_name,
            'widgets' => $this->widgets,
            'layout_config' => $this->layout_config,
            'refresh_interval' => $this->refresh_interval,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
