<?php

namespace App\Providers;

use App\Models\PhoneBook;
use App\Models\User;
use App\Services\API\CountryCodeService;
use App\Services\API\TimezoneService;
use App\Services\Interfaces\PhoneBookingInterface;
use App\Services\Interfaces\UserInterface;
use App\Services\PhoneBookingService;
use App\Services\UserService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CountryCodeService::class, function ($app) {
            return new CountryCodeService($app->make(Client::class));
        });

        $this->app->singleton(TimezoneService::class, function ($app) {
            return new TimezoneService($app->make(Client::class));
        });

        $this->app->bind(PhoneBookingInterface::class, function ($app) {
            return new PhoneBookingService($app->make(PhoneBook::class));
        });

        $this->app->bind(UserInterface::class, function ($app) {
            return new UserService($app->make(User::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
