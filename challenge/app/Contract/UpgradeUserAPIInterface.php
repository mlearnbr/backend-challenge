<?php

namespace App\Contract;

use App\DTO\StoreUserAPIDTO;
use App\DTO\UpgradeUserDTO;

interface UpgradeUserAPIInterface
{
    
	public function handle(UpgradeUserDTO $dataDTO);  
}
