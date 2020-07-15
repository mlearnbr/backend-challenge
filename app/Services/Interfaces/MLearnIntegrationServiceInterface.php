<?php


namespace App\Services\Interfaces;


use App\Models\User;

interface MLearnIntegrationServiceInterface
{
    public function createUser(User $user, string $password = null) : string;

    public function upgradeUserAccess(User $user) : void;

    public function downgradeUserAccess(User $user) : void;
}
