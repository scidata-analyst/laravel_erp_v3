<?php

namespace App\Http\Requests\Sales;

use App\Traits\Validation\ValidationResponseTrait;
use App\Rules\Sales\PromotionStatusRule;
use App\Rules\Sales\PromotionDiscountTypeRule;
use App\Rules\Common\PaginationLimit;
use Illuminate\Foundation\Http\FormRequest;

class PromotionsRequest extends FormRequest
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
                'status' => ['nullable', new PromotionStatusRule],
                'search' => 'nullable|string'
            ];
        }

        return [
            'promotion_name' => 'required_without_all:name,code|string|max:255',
            'name' => 'required_without_all:promotion_name,code|string|max:255',
            'code' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'discount_id' => 'nullable|exists:discounts,id',
            'discount_type' => ['nullable', new PromotionDiscountTypeRule],
            'type' => ['nullable', new PromotionDiscountTypeRule],
            'discount_value' => 'nullable|numeric|min:0',
            'value' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'minimum_purchase' => 'nullable|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'minimum_order_amount' => 'nullable|numeric|min:0',
            'min_purchase_amount' => 'nullable|numeric|min:0',
            'status' => ['required', new PromotionStatusRule],
            'applicable_to' => 'nullable',
            'applicable_products' => 'nullable|array',
            'usage_limit' => 'nullable|integer|min:0',
            'used_count' => 'nullable|integer|min:0',
            'created_by' => 'nullable|integer',
        ];
    }
}
