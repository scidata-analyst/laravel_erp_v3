<?php

namespace App\DTOs\Reports;

use App\Models\Reports\BiDashboards;

/**
 * Data Transfer Object for BI Dashboards.
 * Used for type-safe transfer of business intelligence dashboard data.
 */
class BiDashboardsDTO
{
    /**
     * Unique identifier of the BI dashboard widget.
     *
     * @var int|null
     */
    public ?int $id;

    /**
     * Name of the widget.
     *
     * @var string|null
     */
    public ?string $widgetName;

    /**
     * Type of chart (e.g., bar, line, pie, area).
     *
     * @var string|null
     */
    public ?string $chartType;

    /**
     * Module that provides the data source.
     *
     * @var string|null
     */
    public ?string $dataSourceModule;

    /**
     * How often to refresh the widget data.
     *
     * @var string|null
     */
    public ?string $refreshRate;

    /**
     * Name of the dashboard.
     *
     * @var string|null
     */
    public ?string $dashboardName;

    /**
     * ID of the user who created the dashboard.
     *
     * @var int|null
     */
    public ?int $createdByUserId;

    /**
     * Status of the dashboard (0 = inactive, 1 = active).
     *
     * @var int|null
     */
    public ?int $status;

    /**
     * Timestamp when the dashboard was created.
     *
     * @var string|null
     */
    public ?string $createdAt;

    /**
     * Timestamp when the dashboard was last updated.
     *
     * @var string|null
     */
    public ?string $updatedAt;

    /**
     * Create a new BiDashboardsDTO instance.
     *
     * @param array $data Data array with keys matching DTO properties
     */
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

    /**
     * Create a DTO instance from a BiDashboards model.
     *
     * @param BiDashboards $model The BiDashboards model instance
     * @return self New DTO instance populated from the model
     */
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

    /**
     * Create a DTO instance from an array of data.
     *
     * @param array $data The data array
     * @return self New DTO instance populated from the array
     */
    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    /**
     * Convert the DTO to an array representation.
     *
     * @return array Array representation of the DTO
     */
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

    /**
     * Convert the DTO to a model-compatible array for creating/updating.
     *
     * @return array Array suitable for model creation or update
     */
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
