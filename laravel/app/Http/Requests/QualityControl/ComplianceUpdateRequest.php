<?php

namespace App\Http\Requests\QualityControl;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Compliance record.
 */
class ComplianceUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'standard_regulation' => ['sometimes', 'string', 'max:255'],
            'scope' => ['sometimes', 'string', 'max:255'],
            'audit_date' => ['sometimes', 'date'],
            'next_audit_date' => ['nullable', 'date'],
            'auditor' => ['sometimes', 'string', 'max:255'],
            'findings_notes' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}