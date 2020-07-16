<?php


namespace App\Services;


use App\Interfaces\User\CreateUserInterface;
use App\Models\User;
use App\Services\Interfaces\MLearnIntegrationServiceInterface;
use GuzzleHttp\Client;

class MLearnIntegrationService implements MLearnIntegrationServiceInterface
{
    private $client;
    private $serviceId;

    public function __construct()
    {
        $this->serviceId = env('MLEARN_SERVICE_ID');
        $this->client = new Client(['base_uri' => env('MLEARN_BASE_URI'), 'headers' => $this->getClientHeaders()]);
    }

    private function getClientHeaders() : array
    {
        return [
          'app-users-group-id' => env('MLEARN_USER_GROUP_ID'),
          'service-id' => $this->serviceId,
          'Authorization' => 'Bearer ' . env('MLEARN_AUTH_TOKEN')
        ];
    }

    public function createUser(User $user, string $password = null): string
    {
        $requestBody = ['msisdn' => $user->getPhone(), 'name' => $user->getName(), 'access_level' => $user->getAccessLevel(), 'external_id' => $user->getId()];
        if ($password !== null) {
            $requestBody['password'] = $password;
        }
        $response = $this->client->post("/integrator/$this->serviceId/users", ['json' => $requestBody]);
        $user = json_decode($response->getBody(), true)['data'];
        return $user['id'];
    }

    public function upgradeUserAccess(User $user): void
    {
        $this->client->put("/integrator/$this->serviceId/users/{$user->getExternalId()}/upgrade");
    }

    public function downgradeUserAccess(User $user): void
    {
        $this->client->put("/integrator/$this->serviceId/users/{$user->getExternalId()}/downgrade");
    }
}
