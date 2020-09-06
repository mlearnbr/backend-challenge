<?php


namespace App\Services;


use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class MlearnApi
{
    private PendingRequest $connection;

    public function __construct()
    {
        $this->connection = Http::withHeaders([
            'service-id' => config('services.api.service_id'),
            'app-users-group-id' => config('services.api.app_users_group_id'),
        ])
            ->withToken(config('services.api.authorization'));
    }

    public function get($url, $data = null)
    {
        return $this->connection->get($url, $data);
    }

    public function post($url, $data)
    {
        return $this->connection->post($url, $data);
    }

    public function put($url, $data = null)
    {
        return $this->connection->put($url, $data);
    }

    public function delete($url)
    {
        return $this->connection->delete($url);
    }

}


