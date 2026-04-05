<?php

namespace App\Http\Requests\Core;

use Illuminate\Foundation\Http\FormRequest;

class DashboardRequest extends FormRequest
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
                'category' => 'nullable|string',
                'period' => 'nullable|string',
                'search' => 'nullable|string'
            ];
        }

        return [
            'metric_name' => 'required|string|max:255',
            'metric_value' => 'required',
            'category' => 'nullable|string',
            'period' => 'nullable|string',
            'extra_data' => 'nullable|array',
        ];
    }
}
