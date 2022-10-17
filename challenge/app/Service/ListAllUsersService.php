<?php

namespace App\Service;

use App\Contract\ListAllUsersInterface;
use App\Models\User;

class ListAllUsersService implements ListAllUsersInterface{

    public function handle()
    {
        return User::paginate(10);
    }
}