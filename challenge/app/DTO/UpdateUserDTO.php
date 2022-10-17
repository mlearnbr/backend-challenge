<?php

namespace App\DTO;

use App\Models\User;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateUserDTO extends DataTransferObject
{
    
    /**
     *
     * @var User
     */
    public User $user;

    /**
     *
     * @var array
     */
    public array $data;
    
   
    
}