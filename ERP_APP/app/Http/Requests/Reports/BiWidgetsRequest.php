<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

class BiWidgetsRequest extends FormRequest
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
                'widget_type' => 'nullable|string|in:Chart,Table,KPI,Gauge',
                'status' => 'nullable|string|in:Active,Inactive',
                'search' => 'nullable|string'
            ];
        }

        return [
            'widget_name' => 'required|string|max:255',
            'widget_type' => 'required|string|in:Chart,Table,KPI,Gauge',
            'data_source' => 'required|string',
            'configuration' => 'required|array',
            'status' => 'nullable|string|in:Active,Inactive',
        ];
    }
}
