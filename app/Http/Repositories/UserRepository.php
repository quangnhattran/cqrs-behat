<?php

namespace App\Http\Repositories;

use App\User;

class UserRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}
