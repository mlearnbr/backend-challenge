<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    /**
     * Testa se um usuário está sendo criado
     */
    public function testUserCreate()
    {
        // Cria um novo Usuário
        $response = $this->json(
            'POST',
            '/user',
            [
                'msisdn' => '+5531944443333',
                'name' => 'Usuário Teste',
                'access_level' => 'free',
                'password' => '123456789'
            ]
        );

        // Verifica se a requisição foi válida
        $response
            ->assertStatus(201)
            ->assertJson(['status' => true]);

        // Verifica se o usuário se encontra no DB
        $this->assertDatabaseHas('users', [
            'msisdn' => '+5531944443333'
        ]);
    }

    /**
     * Testa se é retornada a lista de usuários
     */
    public function testUserList()
    {
        // Cria 10 Usuários no DB
        factory(User::class, 10)->make();

        $response = $this->get('/user');

        $response->assertStatus(200);
    }

    /**
     * Testa se o usuário teve um upgrade
     */
    public function testUserUpgrade()
    {
        $user = factory(User::class)->make();

        //Envia requisição de upgrade
        $response = $this->json(
            'PUT',
            '/user/upgrade',
            ['id' => $user->id]
        );

        // Verifica se o usuário teve um upgrade
        $this->assertDatabaseHas('users', [
            'id' => $user->id, 'access_level' => 'premium'
        ]);
    }

    /**
     * Testa se um usuário teve um downgrade
     */
    public function testUserDowngrade()
    {
        $user = factory(User::class)->make([
            'access_level' => 'premium',
        ]);

        //Envia requisição de upgrade
        $response = $this->json(
            'PUT',
            '/user/downgrade',
            ['id' => $user->id]
        );

        // Verifica se o usuário teve um upgrade
        $this->assertDatabaseHas('users', [
            'id' => $user->id, 'access_level' => 'free'
        ]);
    }
}
