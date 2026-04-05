<?php

namespace App\Rules\Sales;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class InvoiceStatusRule implements ValidationRule
{
    protected array $allowedStatuses = ['draft', 'sent', 'paid', 'overdue', 'cancelled'];

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
