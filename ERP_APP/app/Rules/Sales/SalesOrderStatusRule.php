<?php

namespace App\Rules\Sales;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SalesOrderStatusRule implements ValidationRule
{
    protected array $allowedStatuses = ['draft', 'confirmed', 'shipped', 'delivered', 'cancelled'];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, $this->allowedStatuses)) {
            $fail('The :attribute must be one of: ' . implode(', ', $this->allowedStatuses));
        }
    }
}
