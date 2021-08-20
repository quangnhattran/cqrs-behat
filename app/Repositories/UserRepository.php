<?php

namespace App\Repositories;

use App\Contracts\User as UserContract;
use App\Models\User;

class UserRepository extends BaseRepository implements UserContract
{
    /**
     * Get Model
     *
     * @return string
     */
    public function getModel(): string
    {
        return User::class;
    }
}
