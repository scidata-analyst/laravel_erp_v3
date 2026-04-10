<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating General Ledger data.
 *
 * Validates fields based on the Gl model fillable attributes:
 * - name: required, string, max 255
 * - type: required, string, max 50
 * - code: required, string, max 50
 * - debit: nullable, numeric, min 0
 * - credit: nullable, numeric, min 0
 * - narration: nullable, string, max 500
 */
class GlRequest extends FormRequest
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
        // Get the GL ID for unique validation on updates
        $glId = $this->route('gl');

        return [
            // Name: required, string, max 255 characters
            'name' => ['required', 'string', 'max:255'],

            // Type: required, string, max 50 characters (e.g., asset, liability, equity, revenue, expense)
            'type' => ['required', 'string', 'max:50'],

            // Code: required, string, max 50 characters, unique in general_ledger
            'code' => [
                'required',
                'string',
                'max:50',
                "unique:general_ledger,code,{$glId},id",
            ],

            // Debit: optional, numeric, must be 0 or greater
            'debit' => ['nullable', 'numeric', 'min:0'],

            // Credit: optional, numeric, must be 0 or greater
            'credit' => ['nullable', 'numeric', 'min:0'],

            // Narration: optional, string, max 500 characters
            'narration' => ['nullable', 'string', 'max:500'],
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
            'name.required' => 'The name is required.',
            'name.max' => 'Name must not exceed 255 characters.',
            'type.required' => 'The type is required.',
            'type.max' => 'Type must not exceed 50 characters.',
            'code.required' => 'The code is required.',
            'code.max' => 'Code must not exceed 50 characters.',
            'code.unique' => 'This code is already in use.',
            'debit.numeric' => 'Debit must be a numeric value.',
            'debit.min' => 'Debit must be at least 0.',
            'credit.numeric' => 'Credit must be a numeric value.',
            'credit.min' => 'Credit must be at least 0.',
            'narration.max' => 'Narration must not exceed 500 characters.',
        ];
    }
}
