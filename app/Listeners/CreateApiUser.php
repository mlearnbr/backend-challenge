<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class CreateApiUser implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UserCreated $event
     * @return bool
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function handle(UserCreated $event)
    {
        $url = config('services.api.host') . 'integrator/' . config('services.api.service_id') . '/users';
        $data = $event->user->toArray();
        $data['external_id'] = $event->user->id;
        $response = Http::withHeaders([
                'service-id' => config('services.api.service_id'),
                'app-users-group-id' => config('services.api.app_users_group_id'),
            ])
            ->withToken(config('services.api.authorization'))
            ->post($url, $data);
        $response->throw();
        return $response->successful();
    }
}
