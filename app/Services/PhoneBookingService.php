<?php

namespace App\Services;

use App\Models\PhoneBook;
use App\Services\Interfaces\PhoneBookingInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class PhoneBookingService implements PhoneBookingInterface
{
    protected PhoneBook $model;

    /**
     * @param PhoneBook $model
     */
    public function __construct(PhoneBook $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $userId
     * @param array $data
     * @return PhoneBook
     */
    public function create(int $userId, array $data): PhoneBook
    {
        $data['user_id'] = $userId;
        $data['inserted_on'] = now();

        return $this->model->createPhoneBook($data);
    }

    /**
     * @param int $userId
     * @param array $data
     * @return PhoneBook
     */
    public function update(int $userId, array $data): PhoneBook
    {
        $data['updated_on'] = now();

        return $this->model->updatePhoneBook($userId, $data);
    }

    /**
     * @param int $userId
     * @param string|null $searchTerm
     * @return LengthAwarePaginator
     */
    public function get(int $userId, string $searchTerm = null): LengthAwarePaginator
    {
        return $this->model->getPhoneBooks($userId, $searchTerm);
    }

    /**
     * @param int $userId
     * @param int $id
     * @return bool
     */
    public function delete(int $userId, int $id): bool
    {
        return $this->model->deletePhoneBook($userId, $id);
    }
}
