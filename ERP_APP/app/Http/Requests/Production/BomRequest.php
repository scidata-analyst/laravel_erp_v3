<?php

namespace App\Http\Requests\Production;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Bill of Materials (BOM) data.
 *
 * Validates fields based on the Bom model fillable attributes:
 * - finished_product_name: required, string, max 255
 * - version: nullable, string, max 50
 * - lead_time_days: nullable, integer, min 0
 * - status: nullable, string, max 50
 */
class BomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the BOM ID for unique validation on updates
        $bomId = $this->route('bom');

        return [
            // Finished product name: required, string, max 255 characters
            'finished_product_name' => ['required', 'string', 'max:255'],

            // Version: optional, string, max 50 characters (e.g., v1, v2.0)
            'version' => ['nullable', 'string', 'max:50'],

            // Lead time days: optional, integer, must be 0 or greater
            'lead_time_days' => ['nullable', 'integer', 'min:0'],

            // Status: optional, string, max 50 characters (e.g., draft, active, deprecated)
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'finished_product_name.required' => 'The finished product name is required.',
            'finished_product_name.max' => 'Finished product name must not exceed 255 characters.',
            'version.max' => 'Version must not exceed 50 characters.',
            'lead_time_days.integer' => 'Lead time days must be an integer.',
            'lead_time_days.min' => 'Lead time days must be at least 0.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
