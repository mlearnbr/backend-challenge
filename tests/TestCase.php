<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;
    protected $faker;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->faker = Factory::create('pt_BR');
        parent::__construct($name, $data, $dataName);
    }
}
