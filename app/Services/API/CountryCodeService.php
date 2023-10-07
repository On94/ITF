<?php

namespace App\Services\API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class CountryCodeService
{
    /**
     * @var Client
     */
    protected Client $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $countryCode
     * @return bool
     * @throws GuzzleException
     */
    public function isValidCountryCode($countryCode): bool
    {
        try {

            $response = $this->client->get(Config::get('apis.countries_api'));

            $continentData = json_decode($response->getBody(), true);

            return isset($continentData[$countryCode]);

        } catch (\Exception $e) {

            Log::error('Error while fetching continent data for country code ' . $countryCode . ': ' . $e->getMessage());

            return false;
        }
    }
}
