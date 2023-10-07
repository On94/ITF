<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PhoneBook extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var string[]
     */
    protected $fillable = ['user_id', 'first_name', 'last_name', 'phone_number', 'country_code', 'time_zone_name'];
    /**
     * @var string
     */
    protected string $createdAt = 'inserted_on';
    /**
     * @var string
     */
    protected string $updatedAt = 'updated_on';

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @param array $data
     * @return PhoneBook
     */
    public function createPhoneBook(array $data): PhoneBook
    {
        return $this->create($data);
    }


    public function updatePhoneBook(int $userId, array $data): PhoneBook
    {
        return tap($this->where('user_id', $userId)->where('id', $data['id']))->update($data)->first();
    }

    /**
     * @param int $userId
     * @param string|null $searchTerm
     * @return LengthAwarePaginator
     */
    public function getPhoneBooks(int $userId, string $searchTerm = null): LengthAwarePaginator
    {
        return $this->where('user_id', $userId)
            ->when($searchTerm, function (Builder $query) use ($searchTerm) {
                return $query->where(function (Builder $query) use ($searchTerm) {
                    $query
                        ->where('first_name', 'like', "%$searchTerm%")
                        ->orWhere('last_name', 'like', "%$searchTerm%");
                });
            })
            ->paginate(20);
    }

    /***
     * @param int $userId
     * @param int $id
     * @return bool
     */
    public function deletePhoneBook(int $userId, int $id): bool
    {
        return $this->where('user_id', $userId)->where('id', $id)->delete();
    }

}
