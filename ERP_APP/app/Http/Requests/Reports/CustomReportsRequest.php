<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

class CustomReportsRequest extends FormRequest
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
                'report_type' => 'nullable|string|in:Sales,Inventory,Finance,HR,Production',
                'status' => 'nullable|string|in:Active,Inactive',
                'search' => 'nullable|string'
            ];
        }

        return [
            'report_name' => 'required_without:name|string|max:255',
            'name' => 'required_without:report_name|string|max:255',
            'report_type' => 'required_without:type|string|in:Sales,Purchase,Inventory,Finance,HR,Production',
            'type' => 'required_without:report_type|string|in:Sales,Purchase,Inventory,Finance,HR,Production',
            'description' => 'nullable|string|max:1000',
            'query_sql' => 'nullable|string',
            'query' => 'nullable|string',
            'parameters' => 'nullable|array',
            'filter_by' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:Active,Inactive',
            'schedule' => 'nullable|string|max:255',
            'format_type' => 'nullable|string|in:PDF,Excel,Both',
            'format' => 'nullable|string|in:PDF,Excel,Both',
        ];
    }
}
