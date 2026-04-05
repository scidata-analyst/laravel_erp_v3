<?php

namespace App\Http\Requests\Logistics;

use Illuminate\Foundation\Http\FormRequest;

class RoutesRequest extends FormRequest
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
                'search' => 'nullable|string'
            ];
        }

        return [
            'route_name' => 'required|string|max:255',
            'start_location' => 'required|string',
            'end_location' => 'required|string',
            'distance' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|in:Active,Inactive',
        ];
    }
}
