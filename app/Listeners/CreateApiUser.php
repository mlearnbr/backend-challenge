<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Services\MlearnApi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class CreateApiUser
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
        $response = new MlearnApi();
        $response->post($url, $data);
        $response->throw();
        return $response->successful();
    }
}
