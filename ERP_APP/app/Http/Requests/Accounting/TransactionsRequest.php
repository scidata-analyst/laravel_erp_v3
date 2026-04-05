<?php

namespace App\Http\Requests\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class TransactionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'account_id' => 'required|integer|exists:gls,id',
            'transaction_type' => 'required|string|in:Debit,Credit',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string',
            'transaction_date' => 'required|date',
        ];
    }
}
