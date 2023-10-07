<?php

namespace App\Http\Requests\API\PhoneBook;

use App\Rules\API\ValidCountryCodeRule;
use App\Rules\API\ValidPhoneNumber;
use App\Rules\API\ValidTimeZoneRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $idRule = $this->method() === 'POST' ? 'nullable' : 'required';
        $idExistsRule = ['exists:phone_books,id'];

        return [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'phone_number' => ['string', 'required', app( ValidPhoneNumber::class)],
            'country_code' => ['string','required', app(ValidCountryCodeRule::class)],
            'time_zone_name' => ['string','required', app(ValidTimeZoneRule::class)],
            'id' => [$idRule, Rule::when($this->method() === 'PUT', $idExistsRule)],
        ];
    }

}

