<?php

namespace App\DTO;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class StoreUserDTO extends DataTransferObject
{
    
    /**
     *
     * @var string
     */
    public string $msisdn;
    
    /**
     *
     * @var string
     */
    public string $name;
 
    /**
     *
     * @var string
     */
    public string $access_level;

    /**
     *
     * @var string|null
     */
    public ?string $password = null;

    
}