<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface UserInterface
{
    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User;

    /**
     * @param int $userId
     * @return bool
     */
    public function delete(int $userId): bool;

    /**
     * @param int $userId
     * @param array $data
     * @return User
     */
    public function update(int $userId, array $data): User;

    /**
     * @param int $userId
     * @return User|null
     */
    public function findById(int $userId):?User;

    /**
     * @param User $user
     * @return string
     */
    public function createAccessToken(User $user):string;

}
