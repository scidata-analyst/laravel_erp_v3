<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing General Ledger entry.
 */
class GlUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $glId = $this->route('gl');
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'type' => ['sometimes', 'string', 'max:50'],
            'code' => ['sometimes', 'string', 'max:50', 'unique:general_ledger,code,' . $glId],
            'debit' => ['nullable', 'numeric', 'min:0'],
            'credit' => ['nullable', 'numeric', 'min:0'],
            'narration' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'code.unique' => 'The ledger code must be unique.',
            'debit.numeric' => 'Debit must be a numeric value.',
            'debit.min' => 'Debit must be at least 0.',
            'credit.numeric' => 'Credit must be a numeric value.',
            'credit.min' => 'Credit must be at least 0.',
        ];
    }
}