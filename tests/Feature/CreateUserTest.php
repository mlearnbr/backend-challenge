<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use DatabaseMigrations;


    public function from(string $url)
    {
        $this->app['session']->setPreviousUrl($url);

        return $this;
    }

    public function testUserCreationSuccessful()
    {
        $userData = User::factory()->raw([
            'password' => '123',
            'password_confirmation' => '123',
        ]);
        $response = $this->from('/users/create')
            ->post('/users', $userData);

        $response->assertRedirect('/users');
    }

    public function testUserCreationFailing()
    {
        $userData = User::factory()->raw([
            'msisdn' => '+55123',
            'password' => '123',
            'password_confirmation' => '1234',
        ]);
        $response = $this->from('/users/create')
            ->post('/users', $userData);

        $response->assertRedirect('/users/create');
    }
}
