<?php

namespace App\Facades;

use App\Models\PhoneBook;
use App\Services\Interfaces\PhoneBookingInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Facade;

/**
 * @method static LengthAwarePaginator get(int $userId, string $searchTerm = null)
 * @method static bool delete(int $userId, int $phoneBookingId)
 * @method static PhoneBook create(int $userId, array $data)
 * @method static PhoneBook update(int $userId, array $data)
 */
class PhoneBookingServiceFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return PhoneBookingInterface::class;
    }

}
