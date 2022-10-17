<?php

namespace App\Service;

use App\Contract\StoreUserInterface;
use App\DTO\StoreUserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreUserService implements StoreUserInterface{

    public function handle(StoreUserDTO $dataDTO)
    {
        $data = $dataDTO->toArray();
        $data['password'] = (isset($data['password']) && $data['password'] == '')? null: Hash::make($data['password']);

        $user = User::create($data);
        

        return $user;
    }
}