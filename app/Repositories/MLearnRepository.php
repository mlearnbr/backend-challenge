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
            '{route}' => $route,
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

        if ($response->successful()) {
            $user->mlearn_id = $response['data']['id'];
            return $user->save();
        }
        return false;
    }
}
