<?php

namespace App\Http\Requests\QualityControl;

use Illuminate\Foundation\Http\FormRequest;

class DefectsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return [
                'per_page' => 'nullable|integer|min:1|max:100',
                'status' => 'nullable|string|in:open,in_progress,resolved,closed',
                'severity' => 'nullable|string|in:low,medium,high,critical',
                'search' => 'nullable|string'
            ];
        }

        return [
            'defect_number' => 'nullable|string|max:100|unique:defects,defect_number,' . ($this->route('defect') ?? 'NULL') . ',id',
            'product_id' => 'required|integer|exists:product_catalogs,id',
            'batch_number' => 'nullable|string|max:100',
            'defect_type' => 'required|string',
            'description' => 'required|string',
            'detected_by' => 'nullable|exists:employees,id',
            'detection_date' => 'nullable|date',
            'severity' => 'required|string|in:low,medium,high,critical,Low,Medium,High,Critical',
            'status' => 'nullable|string|in:open,in_progress,resolved,closed,Open,In Review,Resolved,Closed',
            'resolution' => 'nullable|string',
            'resolution_date' => 'nullable|date',
            'cost_impact' => 'nullable|numeric|min:0',
            'affected_quantity' => 'nullable|integer|min:0',
            'compliance_id' => 'nullable|exists:compliances,id',
        ];
    }
}
