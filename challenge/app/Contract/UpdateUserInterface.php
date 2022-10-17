<?php

namespace App\Contract;

use App\DTO\UpdateUserDTO;

interface UpdateUserInterface
{
    
	public function handle(UpdateUserDTO $dataDTO);  
}
