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
            $client = new Client([
                "base_uri" => env("URL_API_MLEARN") . "integrator/" . env("SERVICE_ID") . "/users",
                'headers' => [
                    "Authorization" => "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiMDY3YTEyMGZmMzg0YWIwYzdjN2UxZmJjYTllZDUwY2JhMGEyMDY4YzQzNGJlNDE4MTJiMmM3NTA5ZWE3NDk5ZGM1ZjllOWVlNjc5ZGM2MzkiLCJpYXQiOjE2NDUxMDQ5NDkuMDA4NzE3LCJuYmYiOjE2NDUxMDQ5NDkuMDA4NzIxLCJleHAiOjE2NzY2NDA5NDguOTk5NzAyLCJzdWIiOiIiLCJzY29wZXMiOlsicmVhZDptYW5hZ2VfdXNlcnMiLCJ3cml0ZTptYW5hZ2VfdXNlcnMiXX0.M3i1zErf6fBqIrI8ddJkXN443hdj0W7MrIP2A1GlmoWLGTo_05Z0P0sDs0f_YgnpxgiwUdC_X-8P39LxUeBmHv5CouQSxdZlQTQwvPkB1rFrAmqoPKYtnP8843TAB90gGAa9AzrQMhlcN5DWqr_LrNy7UNetccloRyNTIPHE6KVgJaUNQVmn3jPcAe4z8qX16-IK-vh-yKRu-PHRU0DY9ukcfUMjg28W1hKkwBNRZ3e5PYFIs32fe21U-rjINytgujRey8B1TVh63jWD3Yqpqt9ChD1ml2i4ksH_h7bKp8xLUUkv0IY9_36s8Y53eVI4cUJb44DDFcPdkwuP2BQaXPzaTKabZhIOWVPG7byqJGuh1wsh-O4PTf5Raa8IxPqLsuTXn9yXdGhOGRwW8pzToDxXfWFhTSiDcOTOg3tsGmWkNc6dscK0xUPndgLXMhBrr6wf0vXDCDlneUTmmftogvusHpFL-dGpS2mgxoAkk78fgJ04E9P6fXreAYRgH8L4D1E7w1d2RB-0kIYf_-nLKHnR1Q_cVYs4BRKaY2E-ijQ7PQk9HtV3Na5ytUHnbjATG_jHe0Ou4CWNSv2y8uYxMk1_R2tN_C-TsOUaXUHLWHB7Avq_883lVwWf0Bu7CwgXnuH0iUdwWeRsXR7CnQxVEokCq_AT3ZmlVbSUKBemBIk",
                    "service-id" => env("SERVICE_ID"),
                    "app-users-group-id" => "20"
                ]
            ]);
            $response = $client->post("users", [
                "body" => json_encode($user->attributesToArray())]);
            return $response;
        }catch (Exception $e){
            return $e;
        }
    }
}
