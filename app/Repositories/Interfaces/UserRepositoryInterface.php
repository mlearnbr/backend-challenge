<?php


namespace App\Repositories\Interfaces;


use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function getAllUsers(): Collection;

    public function saveUser(User $user);

    public function findOrFailUser(int $userId) : User;
}
