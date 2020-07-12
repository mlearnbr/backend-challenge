<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\User;

class ApiUserDowngrade implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $apiClient, $apiEndpoint;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $apiHeaders = [
            'service-id' => env('API_SERVICE_ID'),
            'app-users-group-id' => env('API_USERS_GROUP_ID')
        ];
        $this->apiClient = Http::withHeaders( $apiHeaders )->withToken( env('API_TOKEN') );
        $this->apiEndpoint = sprintf( '%s/integrator/%s/users/%s/downgrade', env('API_STAGING_URL'), env('API_SERVICE_ID'), $user->external_id );
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->apiClient->put( $this->apiEndpoint );
    }
}
