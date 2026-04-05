<?php

namespace App\DTOs\Reports;

class BiWidgetsDTO
{
    public function __construct(
        public readonly string $widget_name,
        public readonly string $widget_type, // Chart, Counter, Table, Gauge
        public readonly string $data_source,
        public readonly ?array $configuration = null,
        public readonly ?string $status = 'Active'
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            widget_name: $data['widget_name'],
            widget_type: $data['widget_type'],
            data_source: $data['data_source'],
            configuration: $data['configuration'] ?? null,
            status: $data['status'] ?? 'Active'
        );
    }

    public function toArray(): array
    {
        return [
            'widget_name' => $this->widget_name,
            'widget_type' => $this->widget_type,
            'data_source' => $this->data_source,
            'configuration' => $this->configuration,
            'status' => $this->status,
        ];
    }
}
