<?php 

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class MlearnApiService
{
    /**
     * Gera uma rota baseada nas configurações do sistema para acesso ao endpoint
     * 
     * @param string $url 
     */
    public function generateRoute($url)
    {
        return config('app.mlearn.host') . 'integrator/' . config('app.mlearn.service') . '/' . $url;
    }

    /**
     * Gera os cabeçalhos obrigatórios em todas as requisições com base nas configurações do sistema para acesso
     */
    public function generateHeaders()
    {
        return [
            'Authorization' => config('app.mlearn.token'),
            'service-id' => config('app.mlearn.service'),
            'app-users-group-id' => config('app.mlearn.group'),
        ];
    }

    /**
     * Registra um usuário do sistema na API mLearn
     * 
     * @param User $user
     */
    public function registerUser(User $user)
    {
        $body = [
            'msisdn' => $user->phone,
            'name' => $user->name,
            'access_level' => $user->access_level,
            'external_id' => $user->uuid,
        ];

        $response = Http::withHeaders($this->generateHeaders())
            ->post($this->generateRoute('users'), $body);

        $response->throw();

        return $response->json();
    }

    /**
     * Obtém um ID de usuário da API mLearn com base no celular
     * 
     * @param User $user
     */
    public function getUserId(User $user)
    {
        $response = Http::withHeaders($this->generateHeaders())
            ->get($this->generateRoute('users'), 'msisdn=' . $user->phone);
        $response->throw();

        return $response->json('data.id');
    }

    /**
     * Faz upgrade de um usuário na API mLearn
     * 
     * @param User $user
     */
    public function upgradeUser(User $user)
    {
        $userId = $this->getUserId($user);
        $url = $this->generateRoute('users/' . $userId . '/upgrade');

        $response = Http::withHeaders($this->generateHeaders())->put($url);
        $response->throw();

        return true;
    }

    /**
     * Faz downgrade de um usuário na API mLearn
     * 
     * @param User $user
     */
    public function downgradeUser(User $user)
    {
        $userId = $this->getUserId($user);
        $url = $this->generateRoute('users/' . $userId . '/downgrade');

        $response = Http::withHeaders($this->generateHeaders())->put($url);
        $response->throw();

        return true;
    }
}
