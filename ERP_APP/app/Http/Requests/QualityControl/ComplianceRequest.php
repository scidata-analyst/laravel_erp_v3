<?php

namespace App\Http\Requests\QualityControl;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Compliance data.
 *
 * Validates fields based on the Compliance model fillable attributes:
 * - standard_regulation: required, string, max 100
 * - scope: nullable, string, max 255
 * - audit_date: required, date
 * - next_audit_date: nullable, date, must be after audit_date
 * - auditor: nullable, string, max 100
 * - findings_notes: nullable, string, max 1000
 * - status: nullable, string, max 50
 */
class ComplianceRequest extends FormRequest
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
        // Get the compliance ID for unique validation on updates
        $complianceId = $this->route('compliance');

        return [
            // Standard/Regulation: required, string, max 100 characters (e.g., ISO 9001, ISO 14001)
            'standard_regulation' => ['required', 'string', 'max:100'],

            // Scope: optional, string, max 255 characters
            'scope' => ['nullable', 'string', 'max:255'],

            // Audit date: required, must be a valid date
            'audit_date' => ['required', 'date'],

            // Next audit date: optional, must be a valid date after audit_date
            'next_audit_date' => ['nullable', 'date', 'after:audit_date'],

            // Auditor: optional, string, max 100 characters
            'auditor' => ['nullable', 'string', 'max:100'],

            // Findings/Notes: optional, string, max 1000 characters
            'findings_notes' => ['nullable', 'string', 'max:1000'],

            // Status: optional, string, max 50 characters (e.g., compliant, non_compliant, pending)
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
            'standard_regulation.required' => 'The standard/regulation is required.',
            'standard_regulation.max' => 'Standard/regulation must not exceed 100 characters.',
            'scope.max' => 'Scope must not exceed 255 characters.',
            'audit_date.required' => 'The audit date is required.',
            'audit_date.date' => 'Please enter a valid date.',
            'next_audit_date.date' => 'Please enter a valid date.',
            'next_audit_date.after' => 'Next audit date must be after the audit date.',
            'auditor.max' => 'Auditor name must not exceed 100 characters.',
            'findings_notes.max' => 'Findings/notes must not exceed 1000 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
