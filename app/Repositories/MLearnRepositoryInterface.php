<?php

namespace App\Repositories;

use App\Models\User;

interface MLearnRepositoryInterface
{
    public function createUser(User $user): bool;
    public function upgradeUser(User $user): bool;
    public function downgradeUser(User $user): bool;
}
