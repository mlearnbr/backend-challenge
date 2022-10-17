<?php

namespace App\DTO;

use App\Models\User;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class FindByExternalIdUserDTO extends DataTransferObject
{

    /**
     *
     * @var string
     */
    public string $id;
    
   
    
}