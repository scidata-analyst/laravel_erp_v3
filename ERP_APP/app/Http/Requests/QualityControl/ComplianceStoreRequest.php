<?php

namespace App\Http\Requests\QualityControl;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Compliance record.
 */
class ComplianceStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'standard_regulation' => ['required', 'string', 'max:255'],
            'scope' => ['required', 'string', 'max:255'],
            'audit_date' => ['required', 'date'],
            'next_audit_date' => ['nullable', 'date'],
            'auditor' => ['required', 'string', 'max:255'],
            'findings_notes' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'standard_regulation.required' => 'The standard regulation is required.',
            'scope.required' => 'The scope is required.',
            'audit_date.required' => 'The audit date is required.',
            'auditor.required' => 'The auditor is required.',
        ];
    }
}