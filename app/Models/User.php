<?php

namespace App\Models;

use App\Interfaces\User\CreateUserInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const DEFAULT_PHONE_COUNTRY_CODE = '+55';

    const FREE_ACCESS = 'free';
    const PREMIUM_ACCESS = 'premium';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function create(CreateUserInterface $createUser) : void
    {
        $this->name = $createUser->getName();
        $this->password = $createUser->createPassword();
        $this->access_level = $createUser->getAccessLevel();
        $this->email = $createUser->getEmail();
        $this->msisdn = self::DEFAULT_PHONE_COUNTRY_CODE . $createUser->getPhone();
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getPhone() : string
    {
        return $this->msisdn;
    }

    public function getAccessLevel() : string
    {
        return $this->access_level;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getExternalId() : string
    {
        return $this->external_id;
    }

    public function toPublicArray() : array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'phone' => $this->getPhone(),
            'email' => $this->getEmail(),
            'accessLevel' => $this->getAccessLevel()
        ];
    }

    public function addExternalId(string $id) : void
    {
        $this->external_id = $id;
    }

    public function upgradeAccess() : void
    {
        if ($this->access_level === self::FREE_ACCESS) {
            $this->access_level = self::PREMIUM_ACCESS;
        }
    }

    public function downgradeAccess() : void
    {
        if ($this->access_level === self::PREMIUM_ACCESS) {
            $this->access_level = self::FREE_ACCESS;
        }
    }
}
