<?php

namespace App\DTOs\Reports;

class BiDashboardsDTO
{
    public readonly ?string $dashboard_name;
    public readonly ?string $dashboard;
    public readonly ?int $refresh_interval;
    public readonly ?string $description;
    public readonly ?string $status;

    public function __construct(array $data)
    {
        $this->dashboard_name   = $data['dashboard_name'] ?? null;
        $this->dashboard        = $data['dashboard'] ?? null;
        $this->refresh_interval = isset($data['refresh_interval']) ? (int)$data['refresh_interval'] : (isset($data['refresh_rate']) ? (int)$data['refresh_rate'] : null);
        $this->description      = $data['description'] ?? null;
        $this->status           = $data['status'] ?? 'Active';
    }
}