<?php

namespace App\DTOs\Reports;

use App\Models\Reports\CustomReports;

class CustomReportsDTO
{
    public ?int $id;

    public ?string $reportName;

    public ?string $module;

    public ?string $selectedFields;

    public ?string $filterBy;

    public ?string $schedule;

    public ?string $outputFormat;

    public ?string $createdAt;

    public ?string $updatedAt;

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

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

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
