<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Ixudra\Curl\Facades\Curl;

class UpgradeUserMLearn implements ShouldQueue
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

        $endpoint = $host . 'integrator/' . $srv_id . '/users/' . $this->user['mlearn_id'] . '/upgrade';
        $response = Curl::to($endpoint)
            ->withHeader('Authorization: ' . $auth)
            ->withHeader('service-id: ' . $srv_id)
            ->withHeader('app-users-group-id: ' . $grp_id)
            ->put();


        $user = User::find($this->user['id']);
        $resposta = json_decode($response, true);
        $user['access_level'] = isset($resposta['data']['id']) ? $resposta['data']['access_level'] : 'p';
        $user->save();
    }
}
