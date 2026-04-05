<?php

namespace App\Http\Requests\Production;

use Illuminate\Foundation\Http\FormRequest;

class BomRequest extends FormRequest
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
                'bom_number' => 'nullable|string',
                'status' => 'nullable|string|in:draft,active,inactive'
            ];
        }

        return [
            'bom_number' => 'required|string|max:100|unique:boms,bom_number,' . ($this->route('bom') ?? 'NULL') . ',id',
            'finished_product' => 'required|string|max:255',
            'version' => 'nullable|string|max:50',
            'lead_time_days' => 'nullable|integer|min:0',
            'estimated_cost' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|in:draft,active,inactive',
            'components' => 'nullable|array',
            'notes' => 'nullable|string',
        ];
    }
}
