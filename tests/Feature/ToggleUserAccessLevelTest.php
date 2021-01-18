<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\MLearnRepositoryInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ToggleUserAccessLevelTest extends TestCase
{
    use DatabaseMigrations;


    public function from(string $url)
    {
        $this->app['session']->setPreviousUrl($url);

        return $this;
    }

    public function testUserUpgrade()
    {
        $user = User::factory()->create([
            'msisdn' => '+5599912345678',
            'name' => 'João da Silva',
            'access_level' => 'free',
        ]);

        $this->mock(MLearnRepositoryInterface::class, function ($mock) {
            return $mock->shouldReceive('upgradeUser')
                ->once()
                ->andReturn(true);
        });

        $response = $this->from(route('users.index'))
            ->put(route('users.upgrade', ['user' => $user->id]));

        $response->assertRedirect(route('users.index'));
    }

    public function testUserDowngrade()
    {
        $user = User::factory()->create([
            'msisdn' => '+5599912345678',
            'name' => 'João da Silva',
            'access_level' => 'premium',
        ]);

        $this->mock(MLearnRepositoryInterface::class, function ($mock) {
            return $mock->shouldReceive('downgradeUser')
                ->once()
                ->andReturn(true);
        });

        $response = $this->from(route('users.index'))
            ->put(route('users.downgrade', ['user' => $user->id]));

        $response->assertRedirect(route('users.index'));
    }
}
