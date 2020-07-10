<?php

namespace App\Services\mLearn;

use Illuminate\Support\Facades\Http;

class MLearn {

    private $connection;
    private $user;

    public function __construct()
    {
        $this->connection = Http::withToken(env('MLEARN_TOKEN'))->withHeaders([
            'service-id' => env('MLEARN_SERVICE_ID'),
            'app-users-group-id' => env('MLEARN_APP_USER_GROUP_ID'),
            'content-type' => 'application/json'
        ]);

    }

    public function downgrade(){
        
        $response = $this->connection->put(env('MLEARN_URL').'integrator/'.env('MLEARN_SERVICE_ID').'/users/'.$this->user->data->id.'/downgrade');
        return $response;
    }
    public function upgrade(){

        $response = $this->connection->put(env('MLEARN_URL').'integrator/'.env('MLEARN_SERVICE_ID').'/users/'.$this->user->data->id.'/upgrade');
        return $response;
    }

    public function search($externalId = false){
        $response = $this->connection->get(env('MLEARN_URL').'integrator/'.env('MLEARN_SERVICE_ID').'/users', [
            'external_id' => $externalId
        ]);

        $this->user = json_decode($response->body());
        return $this;
    }

    public function create($user = false){
        
        $response = $this->connection->post(env('MLEARN_URL').'integrator/'.env('MLEARN_SERVICE_ID').'/users', [
            'msisdn' => $user->msisdn,
            'name' => $user->name,
            'access_level' => $user->access_level,
            'external_id' => $user->id
        ]);

        return $response;
    }

}