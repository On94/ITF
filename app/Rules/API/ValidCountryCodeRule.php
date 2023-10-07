<?php

namespace App\Rules\API;

use App\Services\API\CountryCodeService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;


class ValidCountryCodeRule implements ValidationRule
{
    /**
     * @var CountryCodeService
     */
    protected CountryCodeService $countryCodeService;

    /**
     * @param CountryCodeService $countryCodeService
     */
    public function __construct(CountryCodeService $countryCodeService)
    {
        $this->countryCodeService = $countryCodeService;
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ( !$this->countryCodeService->isValidCountryCode($value)) {
            $fail("The $attribute 'The :attribute is not a valid country code.");
        }
    }
}
