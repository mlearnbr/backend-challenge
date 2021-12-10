<?php

namespace App\Services\Contracts;

interface IMLearnService
{
    public function addUser(array $data);
    public function editUser(array $data);
    public function deleteUser(int $id);
}
