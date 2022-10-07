<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class QualificaService
{
    /**
     * Host variable
     *
     * @var mixed
     */
    private $host;

    /**
     * Client variable
     *
     * @var mixed
     */
    private $client;

    /**
     * Authorization variable
     *
     * @var mixed
     */
    private $authorization;

    /**
     * Service-Id variable
     *
     * @var mixed
     */
    private $serviceId;

    /**
     * App-Users-Group-Id variable
     *
     * @var mixed
     */
    private $appUsersGroupId;

    /**
     * Qualifica Service Constructor
     */
    public function __construct()
    {
        $this->host = env('QUALIFICA_HOST');
        $this->authorization = env('QUALIFICA_AUTHORIZATION');
        $this->serviceId = env('QUALIFICA_SERVICE_ID');
        $this->appUsersGroupId = env('QUALIFICA_APP_USERS_GROUP_ID');

        $this->client = new Client([
            'base_uri' => $this->host,
            'timeout' => 60,
            'headers' => [
                'Authorization' => $this->authorization,
                'service-id' => $this->serviceId,
                'app-users-group-id' => $this->appUsersGroupId
            ]
        ]);

    }

    /**
     * Method that search registered user
     *
     * @param $msisdn
     * @param $externalId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function searchUser($msisdn, $externalId)
    {
        return $this->client->get('integrator/' . $this->serviceId . "/users?msisdn={$msisdn}&external_id={$externalId}");
    }

    /**
     * Method that return registered user
     *
     * @param $qualificaId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function returnUser($qualificaId)
    {
        return $this->client->get('integrator/' . $this->serviceId . "/users/{$qualificaId}");
    }

    /**
     * Method that register user
     *
     * @param $data
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function storeUser($data)
    {
        return $this->client->post('integrator/' . $this->serviceId . '/users', [
            'form_params' => $data
        ]);
    }

    /**
     * Method that update registered user
     *
     * @param $data
     * @param $userId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function updateUser($data, $userId)
    {
        return $this->client->put('integrator/' . $this->serviceId . "/users/{$userId}", [
            'form_params' => $data
        ]);
    }

    /**
     * Method that upgrade registered user
     *
     * @param $userId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function upgradeUser($userId)
    {
        return $this->client->put('integrator/' . $this->serviceId . "/users/{$userId}/upgrade");
    }

    /**
     * Method that downgrade registered user
     *
     * @param $userId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function downgradeUser($userId)
    {
        return $this->client->put('integrator/' . $this->serviceId . "/users/{$userId}/downgrade");
    }

    /**
     * Method that delete registered user
     *
     * @param $userId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function deleteUser($userId)
    {
        return $this->client->delete('integrator/' . $this->serviceId . "/users/{$userId}");
    }
}
