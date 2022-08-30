<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;
use Mockery\Exception;

class IntegrationService
{
    public function createUserMlearn(User $user)
    {
        try {
            $dados = $user->attributesToArray();
            $dados["external_id"] = $dados["id"];
            $client = new Client([
                "base_uri" => env("URL_API_MLEARN") . "integrator/" . env("SERVICE_ID") . "/users",
                'headers' => [
                    "Authorization" => "Bearer " . env("MLEARN_API_TOKEN"),
                    "service-id" => env("SERVICE_ID"),
                    "app-users-group-id" => "20",
                    "accept" => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]);
            $response = $client->post("users", [
                "body" => json_encode($dados),
                'decode_content' => true
            ]);
            $values = (string)$response->getBody();
            return json_decode($values);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function upgradeUserMlearn(User $user)
    {
        try {
            $client = new Client([
                "base_uri" => env("URL_API_MLEARN") . "integrator/" . env("SERVICE_ID") . "/users/",
                'headers' => [
                    "Authorization" => "Bearer " . env("MLEARN_API_TOKEN"),
                    "service-id" => env("SERVICE_ID"),
                    "app-users-group-id" => "20"
                ]
            ]);
            $req = $user->id_mlearn . "/upgrade";
            $response = $client->put($req);
            $values = (string)$response->getBody();
            return json_decode($values);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function downgradeUserMlearn(User $user)
    {
        try {
            $client = new Client([
                "base_uri" => env("URL_API_MLEARN") . "integrator/" . env("SERVICE_ID") . "/users/",
                'headers' => [
                    "Authorization" => "Bearer " . env("MLEARN_API_TOKEN"),
                    "service-id" => env("SERVICE_ID"),
                    "app-users-group-id" => "20"
                ]
            ]);
            $req = $user->id_mlearn . "/downgrade";
            $response = $client->put($req);
            $values = (string)$response->getBody();
            return json_decode($values);
        } catch (Exception $e) {
            return $e;
        }
    }
}
