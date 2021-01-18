<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Http;

final class MLearnRepository implements MLearnRepositoryInterface
{
    public function fullUrl($route)
    {
        return strtr('{base_url}/integrator/{service_id}/{route}', [
            '{base_url}' => config('services.mlearn.base_url'),
            '{service_id}' => config('services.mlearn.service_id'),
            '{route}' => ltrim($route, '/'),
        ]);
    }

    public function getApiClient()
    {
        return Http::withToken(config('services.mlearn.token'))
            ->withHeaders([
                'service-id' => config('services.mlearn.service_id'),
                'app-users-group-id' => config('services.mlearn.app_users_group_id'),
            ]);
    }

    public function createUser(User $user): bool
    {
        $response = $this->getApiClient()->post($this->fullUrl('users'), [
            'msisdn' => $user->msisdn,
            'name' => $user->name,
            'access_level' => $user->access_level,
            'password' => $user->password,
        ])->throw();

        if (!$response->successful()) {
            return false;
        }

        $user->mlearn_id = $response['data']['id'];
        return $user->save();
    }

    private function toggleUserAccessLevel(User $user, string $type)
    {
        $response = $this->getApiClient()->put($this->fullUrl('users/' . $user->mlearn_id . '/' . $type))
            ->throw();

        if (!$response->successful()) {
            return false;
        }

        $user->access_level = $response['data']['access_level'];
        return $user->save();
    }

    public function upgradeUser(User $user): bool
    {
        return $this->toggleUserAccessLevel($user, 'upgrade');
    }

    public function downgradeUser(User $user): bool
    {
        return $this->toggleUserAccessLevel($user, 'downgrade');
    }
}
