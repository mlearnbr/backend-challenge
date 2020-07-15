<?php


namespace App\Interfaces\User;


interface CreateUserInterface
{
    public function getName() : string;
    public function getPhone() : string;
    public function getEmail() : string;
    public function createPassword() : string;
    public function getOriginalPassword() : string;
    public function getAccessLevel() : ? string;
}
