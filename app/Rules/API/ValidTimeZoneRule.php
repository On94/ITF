<?php

namespace App\Rules\API;

use App\Services\API\TimezoneService;
use Closure;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidTimeZoneRule implements ValidationRule
{
    /**
     * @var TimezoneService
     */
    protected TimezoneService $timezoneService;

    /**
     * @param TimezoneService $timezoneService
     */
    public function __construct(TimezoneService $timezoneService)
    {
        $this->timezoneService = $timezoneService;
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     * @throws GuzzleException
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->timezoneService->isValidTimezone($value)) {
            $fail("The $attribute 'The :attribute is not a valid time zone name.");
        }
    }
}
