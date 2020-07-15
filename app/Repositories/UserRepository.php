<?php


namespace App\Repositories;


use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers(): Collection
    {
        return User::all();
    }

    public function saveUser(User $user)
    {
        $user->save();
    }

    public function findOrFailUser(int $userId): User
    {
        return User::findOrFail($userId);
    }
}
