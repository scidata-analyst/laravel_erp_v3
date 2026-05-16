<?php

namespace App\DTOs\Reports;

use App\Models\Reports\CustomReports;

/**
 * Data Transfer Object for Custom Reports.
 * Used for type-safe transfer of custom report data.
 */
class CustomReportsDTO
{
    /**
     * Unique identifier of the custom report.
     *
     * @var int|null
     */
    public ?int $id;

    /**
     * Name of the custom report.
     *
     * @var string|null
     */
    public ?string $reportName;

    /**
     * Module that the custom report belongs to.
     *
     * @var string|null
     */
    public ?string $module;

    /**
     * Fields selected for the custom report.
     *
     * @var string|null
     */
    public ?string $selectedFields;

    /**
     * Filter criteria for the custom report.
     *
     * @var string|null
     */
    public ?string $filterBy;

    /**
     * Schedule for report generation (cron expression or frequency).
     *
     * @var string|null
     */
    public ?string $schedule;

    /**
     * Output format of the custom report (e.g., PDF, Excel, CSV).
     *
     * @var string|null
     */
    public ?string $outputFormat;

    /**
     * Timestamp when the custom report was created.
     *
     * @var string|null
     */
    public ?string $createdAt;

    /**
     * Timestamp when the custom report was last updated.
     *
     * @var string|null
     */
    public ?string $updatedAt;

    /**
     * Create a new CustomReportsDTO instance.
     *
     * @param array $data Data array with keys matching DTO properties
     */
    public function __construct(array $data = [])
    {
        $this->id = isset($data['id']) ? (int) $data['id'] : null;
        $this->reportName = $data['report_name'] ?? null;
        $this->module = $data['module'] ?? null;
        $this->selectedFields = $data['selected_fields'] ?? null;
        $this->filterBy = $data['filter_by'] ?? null;
        $this->schedule = $data['schedule'] ?? null;
        $this->outputFormat = $data['output_format'] ?? null;
        $this->createdAt = $data['created_at'] ?? null;
        $this->updatedAt = $data['updated_at'] ?? null;
    }

    /**
     * Create a DTO instance from a CustomReports model.
     *
     * @param CustomReports $model The CustomReports model instance
     * @return self New DTO instance populated from the model
     */
    public static function fromModel(CustomReports $model): self
    {
        return new self([
            'id' => $model->id,
            'report_name' => $model->report_name,
            'module' => $model->module,
            'selected_fields' => $model->selected_fields,
            'filter_by' => $model->filter_by,
            'schedule' => $model->schedule,
            'output_format' => $model->output_format,
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
            'report_name' => $this->reportName,
            'module' => $this->module,
            'selected_fields' => $this->selectedFields,
            'filter_by' => $this->filterBy,
            'schedule' => $this->schedule,
            'output_format' => $this->outputFormat,
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
            'report_name' => $this->reportName,
            'module' => $this->module,
            'selected_fields' => $this->selectedFields,
            'filter_by' => $this->filterBy,
            'schedule' => $this->schedule,
            'output_format' => $this->outputFormat,
        ];
    }
}
