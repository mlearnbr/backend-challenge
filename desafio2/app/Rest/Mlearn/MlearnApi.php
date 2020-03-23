<?php
namespace App\Api;

use GuzzleHttp\Client as GuzzleClient;
use App\Api\MlearnApi\User;

class MlearnApi {
    /**
     * @param Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new GuzzleClient(
            [
                'base_url' => env('MLEARN_URL_STAGING'),
                'base_uri' => env('MLEARN_URL_STAGING'),
                'headers' => [
                    'Authorization' => 'Bearer ' . env('MLEARN_TOKEN'),
                    'service-id' => env('MLEARN_SERVICE_ID'),
                    'app-users-group-id' => env('MLEARN_APP_USER_GROUP_ID'),
                    'content-type' => 'application/json'
                ],
            ]
        );
    }

    /**
     * Creates a new user.
     * @param User $oUser
     * @return mixed
     * @throws \Exception
     */
    public function createUser(User $oUser)
    {
        $response = $this->client->request('POST', 'integrator/'.env('MLEARN_SERVICE_ID').'/users', ['body' => $oUser->toJson()]);
        if(!$response->withStatus(200)){
            throw new \Exception("Erro ao criar usuário: ".$response->getReasonPhrase());
        }

        return json_decode($response->getBody(), true);
    }

    /**
     * Update user.
     * @param User $oUser
     * @throws \Exception
     */
    public function updateUser(User $oUser)
    {
        $response = $this->client->request('PUT', 'integrator/'.env('MLEARN_SERVICE_ID').'/users/'.$oUser->mlearn_id, ['body' => $oUser->toJson()]);
        if(!$response->withStatus(200)){
            throw new \Exception("Erro ao editar usuário: ".$response->getReasonPhrase());
        }
    }

    /**
     * Upgrade user.
     * @param User $oUser
     * @throws \Exception
     */
    public function upgrade(User $oUser)
    {
        $response = $this->client->request('PUT', 'integrator/'.env('MLEARN_SERVICE_ID').'/users/'.$oUser->mlearn_id.'/upgrade');
        if(!$response->withStatus(200)){
            throw new \Exception("Erro ao realizar upgrade de usuário: ".$response->getReasonPhrase());
        }
    }

    /**
     * Downgrade user.
     * @param User $oUser
     * @throws \Exception
     */
    public function downgrade(User $oUser)
    {
        $response = $this->client->request('PUT', 'integrator/'.env('MLEARN_SERVICE_ID').'/users/'.$oUser->mlearn_id.'/downgrade');
        if(!$response->withStatus(200)){
            throw new \Exception("Erro ao realizar downgrade de usuário: ".$response->getReasonPhrase());
        }
    }

    /**
     * Delete user.
     * @param User $oUser
     * @throws \Exception
     */
    public function deleteUser(User $oUser)
    {
        $response = $this->client->request('DELETE', 'integrator/'.env('MLEARN_SERVICE_ID').'/users/'.$oUser->mlearn_id);
        if(!$response->withStatus(200)){
            throw new \Exception("Erro ao deletar usuário: ".$response->getReasonPhrase());
        }
    }


    /**
     * Find user.
     * @param User $oUser
     * @return mixed
     * @throws \Exception
     */
    public function findUser(User $oUser)
    {
        $response = $this->client->request('GET', 'integrator/'.env('MLEARN_SERVICE_ID').'/users', ['body' => $oUser->toJson()]);
        if(!$response->withStatus(200)){
            throw new \Exception("Erro ao deletar usuário: ".$response->getReasonPhrase());
        }

        return json_decode($response->getBody(), true);
    }

}