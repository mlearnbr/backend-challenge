<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\MLearnRepositoryInterface;
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

        $this->mock(MLearnRepositoryInterface::class, function ($mock) {
            return $mock->shouldReceive('createUser')
                ->once()
                ->andReturn(true);
        });

        $response = $this->from(route('users.create'))
            ->post(route('users.store'), $userData);

        $response->assertRedirect(route('users.index'));
    }

    public function testUserCreationFailing()
    {
        $userData = User::factory()->raw([
            'msisdn' => '+55123',
            'password' => '123',
            'password_confirmation' => '1234',
        ]);

        $this->mock(MLearnRepositoryInterface::class, function ($mock) {
            return $mock->shouldNotReceive('createUser');
        });

        $response = $this->from(route('users.create'))
            ->post(route('users.store'), $userData);

        $response->assertRedirect(route('users.create'));
    }
}
