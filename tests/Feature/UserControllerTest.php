<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    private $createdUserId;

    public function testCreateUserSuccess()
    {
        $user = [
            'name' => 'John Doe',
            'phone' => $this->faker->numberBetween(10, 99) . $this->faker->numberBetween(900000000, 999999999),
            'email' => 'john@test.com',
            'password' => 'secret',
            'accessLevel' => User::FREE_ACCESS
        ];

        $response = $this->postJson('/api/users', $user);
        $response->assertStatus(200);
        $userInDatabase = [
            'name' => 'John Doe',
            'msisdn' => '+55' . $user['phone'],
            'email' => 'john@test.com',
            'access_level' => User::FREE_ACCESS
        ];
        $this->assertDatabaseHas('users', $userInDatabase);
        $this->createdUserId = json_decode($response->getContent(), true)['data']['userId'];
    }

    public function testGetUsersSuccess()
    {
        $this->testCreateUserSuccess();
        $response = $this->get('/api/users');
        $response->assertStatus(200);
        $users = json_decode($response->getContent(), true)['data'];
        $this->assertCount(1, $users);
        $userKeys = ['id', 'name', 'phone', 'email', 'accessLevel'];
        foreach ($userKeys as $userKey) {
            $this->assertArrayHasKey($userKey, $users[0]);
        }
    }

    public function testUpgradeUserSuccess()
    {
        $this->testCreateUserSuccess();
        $response = $this->put('/api/users/upgrade/' . $this->createdUserId);
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $this->createdUserId, 'access_level' => User::PREMIUM_ACCESS]);
    }

    public function testDowngradeUserSuccess()
    {
        $this->testUpgradeUserSuccess();
        $response = $this->put('/api/users/downgrade/' . $this->createdUserId);
        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $this->createdUserId, 'access_level' => User::FREE_ACCESS]);
    }
}
