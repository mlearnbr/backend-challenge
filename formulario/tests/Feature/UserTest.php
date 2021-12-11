<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_users()
    {
        $response = $this->getJson('/api/user');

        $response->assertStatus(200);
    }

    public function test_get_count_users()
    {
        User::factory()->count(10)->create();

        $response = $this->getJson('/api/user');

        $response->assertJsonCount(10, 'data');
        $response->assertStatus(200);
    }

    public function test_notfound_users()
    {
        $response = $this->getJson('/api/user/fake_value');

        $response->assertStatus(404);
    }

    public function test_get_user()
    {
        $user = User::factory()->create();

        $response = $this->getJson("/api/user/{$user->uuid}");

        $response->assertStatus(200);
    }

    public function test_validations_create_user()
    {
        $response = $this->postJson('/api/user/create', []);

        $response->assertStatus(422);
    }

    public function test_create_user()
    {
        $user = User::factory()->create();
        $response = $this->postJson('/api/user/create', [
            'msisdn'=> $user->msisdn,
            'name'=> $user->name,
            'access_level'=> $user->access_level,
            'password'=> $user->password,
            'external_id'=> $user->external_id
        ]);

        $response->assertStatus(201);
    }

    public function test_validation_update_user()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/user/edit", [
            'id'=> $user->id,
        ]);

        $response->assertStatus(422);
    }

    public function test_404_update_user()
    {
        $response = $this->putJson('/api/user/fake_value', [
            'name' => 'User Updated'
        ]);

        $response->assertStatus(404);
    }

    public function test_update_user()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/user/edit", [
            'id'=> $user->id,
            'msisdn'=> $user->msisdn,
            'name'=> $user->name,
            'access_level'=> $user->access_level,
            'password'=> $user->password,
            'external_id'=> $user->external_id
        ]);

        $response->assertStatus(200);
    }

    public function test_404_delete_user()
    {
        $response = $this->deleteJson("/api/user/delete", [
            'id' => 99999
        ]);

        $response->assertStatus(403);
    }

    public function test_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/user/delete",[
                    'id' => $user->id
        ]);

        $response->assertStatus(200);
    }

}
