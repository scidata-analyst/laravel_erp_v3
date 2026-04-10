<?php

namespace App\Http\Requests\Production;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Bill of Materials.
 */
class BomStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'finished_product_name' => ['required', 'string', 'max:255'],
            'version' => ['required', 'string', 'max:20'],
            'lead_time_days' => ['required', 'integer', 'min:0'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'finished_product_name.required' => 'The finished product name is required.',
            'version.required' => 'The version is required.',
            'lead_time_days.required' => 'The lead time is required.',
            'lead_time_days.integer' => 'Lead time must be an integer.',
        ];
    }
}