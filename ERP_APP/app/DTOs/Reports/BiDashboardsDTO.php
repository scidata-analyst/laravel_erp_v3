<?php

namespace App\DTOs\Reports;

use App\Models\Reports\BiDashboards;

class BiDashboardsDTO
{
    public ?int $id;

    public ?string $widgetName;

    public ?string $chartType;

    public ?string $dataSourceModule;

    public ?string $refreshRate;

    public ?string $dashboardName;

    public ?int $createdByUserId;

    public ?int $status;

    public ?string $createdAt;

    public ?string $updatedAt;

    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->widgetName = $data['widget_name'] ?? null;
        $this->chartType = $data['chart_type'] ?? null;
        $this->dataSourceModule = $data['data_source_module'] ?? null;
        $this->refreshRate = $data['refresh_rate'] ?? null;
        $this->dashboardName = $data['dashboard_name'] ?? null;
        $this->createdByUserId = isset($data['created_by_user_id']) ? (int) $data['created_by_user_id'] : null;
        $this->status = isset($data['status']) ? (int) $data['status'] : null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    public static function fromModel(BiDashboards $model): self
    {
        return new self([
            'id' => $model->id,
            'widget_name' => $model->widget_name,
            'chart_type' => $model->chart_type,
            'data_source_module' => $model->data_source_module,
            'refresh_rate' => $model->refresh_rate,
            'dashboard_name' => $model->dashboard_name,
            'created_by_user_id' => $model->created_by_user_id,
            'status' => $model->status,
            'created_at' => $model->created_at?->toIso8601String(),
            'updated_at' => $model->updated_at?->toIso8601String(),
        ]);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'widget_name' => $this->widgetName,
            'chart_type' => $this->chartType,
            'data_source_module' => $this->dataSourceModule,
            'refresh_rate' => $this->refreshRate,
            'dashboard_name' => $this->dashboardName,
            'created_by_user_id' => $this->createdByUserId,
            'status' => $this->status,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function toModel(): array
    {
        return [
            'widget_name' => $this->widgetName,
            'chart_type' => $this->chartType,
            'data_source_module' => $this->dataSourceModule,
            'refresh_rate' => $this->refreshRate,
            'dashboard_name' => $this->dashboardName,
            'created_by_user_id' => $this->createdByUserId,
            'status' => $this->status,
        ];
    }
}
