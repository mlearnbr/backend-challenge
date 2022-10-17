<?php

namespace App\Contract;

use App\DTO\StoreUserDTO;

interface StoreUserInterface
{
    
	public function handle(StoreUserDTO $dataDTO);  
}
