<?php
namespace App\Services\mlearn;

use App\Services\Contracts\IMLearnService;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Models\User;
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


    public function upgradeUser(string $id)
    {
        try
        {

            $response = $this->httpClient->put("/integrator/qualifica/users/".$id."/upgrade", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token ,
                    'Content-Type' => 'application/json',
                    'service-id' => 'qualifica',
                    'app-users-group-id' => '20'
                ]
            ]);

            $response = json_decode($response->getBody()->getContents());

             //update mlearn_id from db local
             $user = User::where('mlearn_id', $id);
             $user->update(['access_level' => $response->data->access_level]);

        }
        catch(BadResponseException $e){
            throw new \Exception($e->getMessage());
        }

        return $response;
    }


    public function downgradeUser(string $id)
    {
        try
        {

            $response = $this->httpClient->put("/integrator/qualifica/users/".$id."/downgrade", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token ,
                    'Content-Type' => 'application/json',
                    'service-id' => 'qualifica',
                    'app-users-group-id' => '20'
                ]
            ]);

            $response = json_decode($response->getBody()->getContents());
        }
        catch(BadResponseException $e){
            throw new \Exception($e->getMessage());
        }

        return $response;
    }

}
