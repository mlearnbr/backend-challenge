<?php

namespace App\Contract;

use App\DTO\StoreUserAPIDTO;

interface StoreUserAPIInterface
{
    
	public function handle(StoreUserAPIDTO $dataDTO);  
}
