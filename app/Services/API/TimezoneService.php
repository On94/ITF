<?php

namespace App\Services\API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class TimezoneService
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
     * @param string $timezone
     * @return bool
     * @throws GuzzleException
     */
    public function isValidTimezone(string $timezone): bool
    {
        try {
            $response = $this->client->get(Config::get('apis.timezones_api') . "{$timezone}");

            if ($response->getStatusCode() === 200) {
                Log::info("Timezone '{$timezone}' is valid.");
                return true;
            } else {
                Log::error("Timezone '{$timezone}' is not valid (HTTP status code: {$response->getStatusCode()}).");
                return false;
            }
        } catch (\Exception $e) {
            Log::error("Error while validating timezone '{$timezone}': " . $e->getMessage());
            return false;
        }
    }
}
