<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct(
        protected readonly User $user
    )
    {
    }

    public function auth(): User
    {
        return User::getAuth();
    }
}