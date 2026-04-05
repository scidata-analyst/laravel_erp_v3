<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ApArRequest extends FormRequest
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
                'type' => 'nullable|in:Payable,Receivable',
                'status' => 'nullable|in:pending,paid,overdue,draft'
            ];
        }

        return [
            'ref_number' => 'required|string|max:50|unique:ap_ars,ref_number,' . $this->route('ap_ar'),
            'party_name' => 'required|string|max:255',
            'type' => 'required|in:Payable,Receivable',
            'due_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'paid' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,paid,overdue,draft',
            'reference' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:1000',
            'balance' => 'nullable|numeric'
        ];
    }

    public function messages(): array
    {
        return [
            'ref_number.required' => 'Reference number is required',
            'ref_number.unique' => 'Reference number already exists',
            'party_name.required' => 'Party name is required',
            'type.required' => 'Type is required',
            'type.in' => 'Type must be one of: Payable, Receivable',
            'due_date.required' => 'Due date is required',
            'due_date.date' => 'Due date must be a valid date',
            'amount.required' => 'Amount is required',
            'amount.numeric' => 'Amount must be a number',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: pending, paid, overdue, draft'
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
