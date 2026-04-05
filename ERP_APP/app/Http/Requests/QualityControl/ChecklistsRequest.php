<?php

namespace App\Http\Requests\QualityControl;

use Illuminate\Foundation\Http\FormRequest;

class ChecklistsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'checklist_number' => 'nullable|string|max:50',
            'checklist_name' => 'required|string|max:255',
            'work_order_id' => 'nullable|exists:work_orders,id',
            'inspector_id' => 'nullable|exists:employees,id',
            'inspection_type' => 'nullable|string|max:100',
            'inspection_date' => 'nullable|date',
            'sample_size' => 'nullable|integer|min:0',
            'items_checked' => 'nullable|integer|min:0',
            'items_passed' => 'nullable|integer|min:0',
            'items' => 'required|array',
            'status' => 'nullable|string|in:pending,passed,failed',
        ];
    }
}
