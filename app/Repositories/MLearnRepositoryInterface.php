<?php

namespace App\Repositories;

use App\Models\User;

interface MLearnRepositoryInterface
{
    /**
     * Creates a User on the mLearn API.
     */
    public function createUser(User $user): bool;

    /**
     * Upgrades the provided User on the mLearn API.
     */
    public function upgradeUser(User $user): bool;

    /**
     * Downgrades the provided User on the mLearn API.
     */
    public function downgradeUser(User $user): bool;
}
