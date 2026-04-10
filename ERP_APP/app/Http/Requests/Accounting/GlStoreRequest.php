<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new General Ledger entry.
 */
class GlStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:50'],
            'code' => ['required', 'string', 'max:50', 'unique:general_ledger,code'],
            'debit' => ['nullable', 'numeric', 'min:0'],
            'credit' => ['nullable', 'numeric', 'min:0'],
            'narration' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The ledger name is required.',
            'type.required' => 'The ledger type is required.',
            'code.required' => 'The ledger code is required.',
            'code.unique' => 'The ledger code must be unique.',
            'debit.numeric' => 'Debit must be a numeric value.',
            'debit.min' => 'Debit must be at least 0.',
            'credit.numeric' => 'Credit must be a numeric value.',
            'credit.min' => 'Credit must be at least 0.',
        ];
    }
}