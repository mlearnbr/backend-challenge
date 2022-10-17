<?php

namespace App\Contract;

use App\DTO\DowngradeUserDTO;

interface DowngradeUserAPIInterface
{
    
	public function handle(DowngradeUserDTO $dataDTO);  
}
