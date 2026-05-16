<?php

namespace App\Http\Requests\Production;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Bill of Materials.
 */
class BomUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'finished_product_name' => ['sometimes', 'string', 'max:255'],
            'version' => ['sometimes', 'string', 'max:20'],
            'lead_time_days' => ['sometimes', 'integer', 'min:0'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'lead_time_days.integer' => 'Lead time must be an integer.',
        ];
    }
}