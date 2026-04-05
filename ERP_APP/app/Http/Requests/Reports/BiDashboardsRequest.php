<?php

namespace App\Http\Requests\Reports;

use Illuminate\Foundation\Http\FormRequest;

class BiDashboardsRequest extends FormRequest
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
                'status' => 'nullable|string|in:Active,Inactive',
                'is_public' => 'nullable|boolean',
                'search' => 'nullable|string'
            ];
        }

        return [
            'dashboard_name' => 'required_without_all:name,dashboard|string|max:255',
            'name' => 'required_without_all:dashboard_name,dashboard|string|max:255',
            'dashboard' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'widgets' => 'nullable',
            'layout_config' => 'nullable',
            'layout' => 'nullable',
            'data_sources' => 'nullable|array',
            'refresh_interval' => 'nullable',
            'refresh_rate' => 'nullable',
            'access_level' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'is_public' => 'nullable|boolean',
            'status' => 'nullable|string|in:Active,Inactive',
        ];
    }
}
