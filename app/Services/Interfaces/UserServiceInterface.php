<?php

namespace App\Services\Interfaces;

use App\Interfaces\User\CreateUserInterface;
use App\Models\User;

interface UserServiceInterface
{
    public function createUser(CreateUserInterface $createUser) : User;

    public function upgradeUser(User $user) : void;

    public function downgradeUser(User $user) : void;
}
