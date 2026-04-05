<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class GlRequest extends FormRequest
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
                'account_type' => 'nullable|string|in:Asset,Liability,Equity,Revenue,Expense',
                'search' => 'nullable|string'
            ];
        }

        return [
            'account_name' => 'required|string|max:255',
            'account_code' => 'required|string|unique:gls,account_code,' . $this->route('gl'),
            'account_type' => 'required|string|in:Asset,Liability,Equity,Revenue,Expense',
            'debit' => 'nullable|numeric|min:0',
            'credit' => 'nullable|numeric|min:0',
            'balance' => 'nullable|numeric',
            'transaction_date' => 'nullable|date',
            'reference_number' => 'nullable|string|max:255',
            'parent_account_id' => 'nullable|exists:gls,id',
            'status' => 'nullable|string|in:active,inactive',
        ];
    }
}
