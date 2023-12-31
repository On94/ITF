<?php

namespace App\Facades;

use App\Models\User;
use App\Services\Interfaces\UserInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool delete(int $userId)
 * @method static User create(array $data)
 * @method static User update(int $userId, array $data)
 * @method static User findById(int $userId)
 * @method static User createAccessToken(int $userId)
 */
class UserServiceFacade extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return UserInterface::class;
    }

}
