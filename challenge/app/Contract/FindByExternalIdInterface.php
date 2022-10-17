<?php

namespace App\Contract;

use App\DTO\FindByExternalIdUserDTO;

interface FindByExternalIdInterface
{
    
	public function handle(FindByExternalIdUserDTO $dataDTO);  
}
