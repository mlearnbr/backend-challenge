<?php

namespace App\Services\Contracts;

interface IMLearnService
{
    public function addUser(array $data);
    public function upgradeUser(string $id);
    public function downgradeUser(string $id);
}
