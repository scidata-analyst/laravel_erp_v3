<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class FinReportsRequest extends FormRequest
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
                'report_type' => 'nullable|in:Balance Sheet,Profit & Loss,Cash Flow,Trial Balance',
                'status' => 'nullable|in:draft,final,archived'
            ];
        }

        return [
            'report_name' => 'required|string|max:255',
            'report_type' => 'required|in:Balance Sheet,Profit & Loss,Cash Flow,Trial Balance',
            'period_start' => 'required|date',
            'period_end' => 'required|date|after_or_equal:period_start',
            'generated_by' => 'required|exists:users,id',
            'status' => 'required|in:draft,final,archived',
            'data_snapshot' => 'nullable|array',
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
