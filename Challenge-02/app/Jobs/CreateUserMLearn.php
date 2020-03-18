<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Env;
use Ixudra\Curl\Facades\Curl;

class CreateUserMLearn implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $host = Env('MLEARN_HOST');
        $srv_id = Env('MLEARN_SRV_ID');
        $auth = Env('MLEARN_AUTH');
        $grp_id = Env('MLEARN_GRP_ID');

        $endpoint = $host . 'integrator/' . $srv_id . '/users';
        $response = Curl::to($endpoint)
            ->withHeader('Authorization: ' . $auth)
            ->withHeader('service-id: ' . $srv_id)
            ->withHeader('app-users-group-id: ' . $grp_id)
            ->withData(
                [
                    'msisdn' => $this->user['msisdn'],
                    'name' => $this->user['name'],
                    'access_level' => $this->user['access_level'],
                    'password' => $this->user['password'],
                    'external_id' => $this->user['id'],
                ]
            )
            ->asJson()
            ->post();

        $user = User::find($this->user['id']);
        $user['mlearn_id'] = isset($response->data->id) ? $response->data->id : $response;
        $user->save();
    }
}
