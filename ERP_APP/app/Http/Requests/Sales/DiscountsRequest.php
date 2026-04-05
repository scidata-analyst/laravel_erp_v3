<?php

namespace App\Http\Requests\Sales;

use App\Traits\Validation\ValidationResponseTrait;
use App\Rules\Common\PaginationLimit;
use App\Rules\Sales\DiscountTypeRule;
use Illuminate\Foundation\Http\FormRequest;

class DiscountsRequest extends FormRequest
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
                'status' => 'nullable|string|in:active,inactive,expired',
                'search' => 'nullable|string'
            ];
        }

        return [
            'discount_name' => 'required_without_all:name,code|string|max:255',
            'name' => 'required_without_all:discount_name,code|string|max:255',
            'code' => 'nullable|string|max:255',
            'discount_type' => ['required_without:type', new DiscountTypeRule],
            'type' => ['required_without:discount_type', new DiscountTypeRule],
            'discount_value' => 'required_without:value|numeric|min:0',
            'value' => 'required_without:discount_value|numeric|min:0',
            'start_date' => 'nullable|date',
            'valid_from' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'valid_to' => 'nullable|date|after_or_equal:valid_from',
            'usage_limit' => 'nullable|integer|min:0',
            'max_uses' => 'nullable|integer|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:active,inactive,expired',
        ];
    }
}
