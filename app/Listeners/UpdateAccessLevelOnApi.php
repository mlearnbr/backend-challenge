<?php

namespace App\Listeners;

use App\Events\AccessLevelUpdated;
use App\Services\MlearnApi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateAccessLevelOnApi
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
     * @param AccessLevelUpdated $event
     * @return bool
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function handle(AccessLevelUpdated $event)
    {
        $getUserUrl = config('services.api.host') . 'integrator/' . config('services.api.service_id') . '/users';
        $api = new MlearnApi();
        $userId = $api->get($getUserUrl, [
            'external_id' => $event->user->id,
        ])['data']['id'];
        $upgrade = $event->upgrade ? 'upgrade' : 'downgrade';
        $url = config('services.api.host') . 'integrator/' . config('services.api.service_id') . '/users/' . $userId . '/' . $upgrade;
        $response = $api->put($url);
        $response->throw();
        return $response->successful();
    }
}
