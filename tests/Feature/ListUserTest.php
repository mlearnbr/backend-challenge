<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ListUserTest extends TestCase
{
    use DatabaseMigrations;

    public function testUserListing()
    {
        $user = User::factory()->create([
            'msisdn' => '+5599912345678',
            'name' => 'João da Silva',
        ]);

        $this->get('/users')
            ->assertOk()
            ->assertSee($user->msisdn)
            ->assertSee($user->name);
    }
}
