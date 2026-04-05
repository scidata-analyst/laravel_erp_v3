<?php

namespace App\Http\Requests\Sales;

use App\Traits\Validation\ValidationResponseTrait;
use App\Rules\Sales\InvoiceStatusRule;
use App\Rules\Common\PaginationLimit;
use Illuminate\Foundation\Http\FormRequest;

class InvoicesRequest extends FormRequest
{
    use ValidationResponseTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return [
                'per_page' => ['nullable', new PaginationLimit],
                'customer_id' => 'nullable|integer',
                'status' => ['nullable', new InvoiceStatusRule],
                'invoice_number' => 'nullable|string'
            ];
        }

        return [
            'invoice_number' => 'required|string|max:50|unique:invoices,invoice_number,' . $this->route('invoice'),
            'customer_id' => 'required|exists:customers,id',
            'sales_order_id' => 'nullable|exists:sales_orders,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'amount' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|min:0|max:100',
            'paid_amount' => 'nullable|numeric|min:0',
            'status' => ['required', new InvoiceStatusRule],
            'notes' => 'nullable|string|max:1000',
            'generated_by' => 'required|exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'invoice_number.unique' => 'Invoice number already exists',
            'customer_id.exists' => 'Selected customer does not exist',
            'sales_order_id.exists' => 'Selected sales order does not exist',
            'due_date.after_or_equal' => 'Due date must be after or equal to invoice date',
            'generated_by.exists' => 'Selected user does not exist'
        ];
    }
}
