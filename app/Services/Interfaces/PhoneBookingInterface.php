<?php

namespace App\Services\Interfaces;

use App\Models\PhoneBook;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PhoneBookingInterface
{
    /**
     * @param int $userId
     * @param array $data
     * @return PhoneBook
     */
    public function create(int $userId, array $data): PhoneBook;

    /**
     * @param int $userId
     * @param array $data
     * @return PhoneBook
     */
    public function update(int $userId, array $data): PhoneBook;

    /**
     * @param int $userId
     * @param string|null $searchTerm
     * @return LengthAwarePaginator
     */
    public function get(int $userId, string $searchTerm = null): LengthAwarePaginator;

    /**
     * @param int $userId
     * @param int $id
     * @return bool
     */
    public function delete(int $userId, int $id): bool;

}
