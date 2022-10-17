<?php

namespace App\Service;

use App\Contract\FindByExternalIdInterface;
use App\Contract\StoreUserAPIInterface;
use App\Contract\UpgradeUserAPIInterface;
use App\DTO\FindByExternalIdUserDTO;
use App\DTO\UpgradeUserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class FindByExternalIdService implements FindByExternalIdInterface{

    public function handle(FindByExternalIdUserDTO $dataDTO)
    {
        $user = User::where('external_id', $dataDTO->id)->first();

        return $user;
    }
}