<?php

namespace App\Http\Apis;

use Illuminate\Support\Facades\Http;

class MLearnApi {
    
    protected $host;
    protected $headers;

    public function __construct()
    {
        $this->host = config('mlearn.host');;

        $this->headers = [
            'Authorization' => "Bearer " . config('mlearn.auth'),
            'service-id' => config('mlearn.service_id'),
            'app-users-group-id' => config('mlearn.user_group_id')
        ];
    }

    public function activateUser($user)
    {
        return Http::withHeaders($this->headers)->post("{$this->host}/integrator/{$this->headers['service-id']}/users", [
            "msisdn" => $user['phone'],
            "name" => $user['name'],
            "access_level" => $user['account'],
	        "password" => $user['password'],
            "external_id" => $user['id']
        ]);
    }

    public function upgradeAccount($access_id)
    {
        return Http::withHeaders($this->headers)->put("{$this->host}/integrator/{$this->headers['service-id']}/users/{$access_id}/upgrade");
    }

    public function downgradeAccount($access_id)
    {
        return Http::withHeaders($this->headers)->put("{$this->host}/integrator/{$this->headers['service-id']}/users/{$access_id}/downgrade");
    }   
}