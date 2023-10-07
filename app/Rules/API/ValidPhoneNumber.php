<?php

namespace App\Rules\API;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->isValidPhoneNumber($value)) {
            $fail("The $attribute 'The :attribute must be in the format: +12 223 444224455'");
        }
    }

    /**
     * @param string $value
     * @return bool
     */
    private function isValidPhoneNumber(string $value): bool
    {
        $pattern = '/^\+\d{2} \d{3} \d{9}$/';
        return preg_match($pattern, $value) === 1;
    }
}

