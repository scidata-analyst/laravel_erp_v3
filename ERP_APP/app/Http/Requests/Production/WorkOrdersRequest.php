<?php

namespace App\Http\Requests\Production;

use Illuminate\Foundation\Http\FormRequest;

class WorkOrdersRequest extends FormRequest
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
                'product_bom_id' => 'nullable|integer|exists:boms,id',
                'status' => 'nullable|string|in:pending,in_progress,completed,cancelled',
                'search' => 'nullable|string'
            ];
        }

        return [
            'wo_number' => 'required|string|unique:work_orders,wo_number,' . $this->route('work_order'),
            'product_bom_id' => 'required|integer|exists:boms,id',
            'qty_to_produce' => 'required|integer|min:1',
            'priority' => 'nullable|string|in:low,normal,high,urgent',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'assigned_to' => 'nullable|exists:employees,id',
            'status' => 'nullable|string|in:pending,in_progress,completed,cancelled',
            'actual_qty_produced' => 'nullable|integer|min:0',
            'scrap_quantity' => 'nullable|integer|min:0',
            'notes' => 'nullable|string',
        ];
    }
}
