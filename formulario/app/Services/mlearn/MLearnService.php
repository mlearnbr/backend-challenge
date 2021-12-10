<?php
namespace App\Services\mlearn;

use App\Services\Contracts\IMLearnService;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Hash;

class MLearnService implements  IMLearnService
{

    protected $token;

    public function __construct(

    ) {
       $this->httpClient = $this->getHttpClient();
       $this->token = config('project_routes.projects.mlerarn_token');
    }

    public function getHttpClient() {
        return new Client(['base_uri' => config('project_routes.projects.mlerarn_api')]);
    }

    public function addUser(array $data)
    {
        try
        {

            $response = $this->httpClient->post("/integrator/qualifica/users", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token ,
                    'Content-Type' => 'application/json',
                    'service-id' => 'qualifica',
                    'app-users-group-id' => '20'
                ],
                'json' => $data
            ]);

            $response = json_decode($response->getBody()->getContents());
        }
        catch(BadResponseException $e){
            throw new \Exception($e->getMessage());
        }

        return $response;
    }


    public function editUser(array $data)
    {
        try
        {

            $response = $this->httpClient->post("/integrator/qualifica/users/".$data['id'], [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token ,
                    'Content-Type' => 'application/json',
                    'service-id' => 'qualifica',
                    'app-users-group-id' => '20'
                ],
                'json' => $data
            ]);

            $response = json_decode($response->getBody()->getContents());
        }
        catch(BadResponseException $e){
            throw new \Exception($e->getMessage());
        }

        return $response;
    }


    public function deleteUser(int $id)
    {
        try
        {

            $response = $this->httpClient->post('/api/cxxxx', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token ,
                    'Content-Type' => 'application/json',
                ],
                'json' => ['user_id' => $id]
            ]);

            $response = json_decode($response->getBody()->getContents());
        }
        catch(BadResponseException $e){
            throw new \Exception($e->getMessage());
        }

        return $response;
    }

}
