<?php

namespace App\Service;

use App\Contract\StoreUserAPIInterface;
use App\Contract\UpdateUserInterface;
use App\Contract\UpgradeUserAPIInterface;
use App\DTO\UpdateUserDTO;
use App\DTO\UpgradeUserDTO;
use Illuminate\Support\Facades\Http;

class UpdateUserService implements UpdateUserInterface{

    public function handle(UpdateUserDTO $dataDTO)
    {
        
        return $dataDTO->user->update($dataDTO->data);
    }
}