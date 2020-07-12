<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\User;

class ApiUserCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $apiClient, $apiEndpoint, $user;

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
        $this->apiEndpoint = sprintf('%s/integrator/%s/users', env('API_STAGING_URL'), env('API_SERVICE_ID'));
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = array(
            'msisdn' => $this->user->msisdn,
            'name' => $this->user->name,
            'access_level' => $this->user->access_level ? $this->user->access_level : 'free',
            'password' => $this->user->password,
            'external_id' => $this->user->id
        );
        $response = $this->apiClient->post( $this->apiEndpoint, $data );
        if ( $response->successful() ) {
            $this->user->update( array(
                'external_id' => $response['data']['id']
            ) );
        }
    }
}
