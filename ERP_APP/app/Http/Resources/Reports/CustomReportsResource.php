<?php

namespace App\Http\Resources\Reports;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomReportsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'report_name' => $this->report_name,
            'type' => $this->type,
            'report_type' => $this->report_type,
            'description' => $this->description,
            'query_sql' => $this->query_sql,
            'query' => $this->query,
            'parameters' => $this->parameters,
            'filter_by' => $this->filter_by,
            'schedule' => $this->schedule,
            'format_type' => $this->format_type,
            'format' => $this->format,
            'last_run_date' => $this->last_run_date,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
