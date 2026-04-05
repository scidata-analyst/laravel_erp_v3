<?php

namespace App\Rules\HR;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ReviewStatusRule implements ValidationRule
{
    protected array $allowedStatuses = ['draft', 'submitted', 'approved', 'rejected'];

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
