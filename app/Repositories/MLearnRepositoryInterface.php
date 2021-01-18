<?php

namespace App\Repositories;

use App\Models\User;

interface MLearnRepositoryInterface
{
    public function createUser(User $user): bool;
}
