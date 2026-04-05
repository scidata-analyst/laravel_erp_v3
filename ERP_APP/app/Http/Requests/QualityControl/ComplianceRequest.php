<?php

namespace App\Http\Requests\QualityControl;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ComplianceRequest extends FormRequest
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
                'status' => 'nullable|in:pending,in_progress,completed',
                'search' => 'nullable|string'
            ];
        }

        return [
            'report_number' => 'nullable|string|max:100|unique:compliances,report_number,' . ($this->route('id') ?? 'NULL') . ',id',
            'standard_name' => 'nullable|string|max:255',
            'version' => 'nullable|string|max:255',
            'compliance_type' => 'required_without:version|string|max:255',
            'standard_reference' => 'required_without:standard_name|string|max:255',
            'audit_date' => 'nullable|date',
            'auditor_id' => 'nullable|exists:employees,id',
            'findings' => 'nullable|array',
            'risk_level' => 'nullable|in:low,medium,high',
            'corrective_actions' => 'nullable|array',
            'due_date' => 'nullable|date|after_or_equal:audit_date',
            'completion_date' => 'nullable|date|after_or_equal:audit_date',
            'expiry_date' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed,Pending,Compliant,Non-Compliant',
            'notes' => 'nullable|string',
            'description' => 'nullable|string',
            'attachments' => 'nullable|array',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}
