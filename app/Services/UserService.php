<?php

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\UserInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserInterface
{
    protected User $model;

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        return $this->model->createUser($data);
    }

    /**
     * @param int $userId
     * @return bool
     */
    public function delete(int $userId): bool
    {
       return $this->model->deleteUser($userId);
    }

    /**
     * @param int $userId
     * @param array $data
     * @return User
     */
    public function update(int $userId, array $data): User
    {
        return $this->model->updateUser($userId,$data);
    }

    /**
     * @param int $userId
     * @return User|null
     */
    public function findById(int $userId): ?User
    {
        return $this->model->findUser($userId);
    }

    /**
     * @param User $user
     * @return string
     */
    public function createAccessToken(User $user): string
    {
        return $user->createToken('AuthToken')->accessToken;
    }
}
