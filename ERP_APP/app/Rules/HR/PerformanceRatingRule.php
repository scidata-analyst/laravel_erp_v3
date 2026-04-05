<?php

namespace App\Rules\HR;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PerformanceRatingRule implements ValidationRule
{
    protected array $allowedRatings = ['Excellent', 'Good', 'Satisfactory', 'Poor'];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, $this->allowedRatings)) {
            $fail('The :attribute must be one of: ' . implode(', ', $this->allowedRatings));
        }
    }
}
