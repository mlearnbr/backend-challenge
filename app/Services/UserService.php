<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Util\Xml\Exception;

class UserService
{
    /**
     * @var IntegrationService
     */
    private $integration;

    public function __construct(User $user, IntegrationService $integrationService)
    {
        $this->model = $user;
        $this->integration = $integrationService;
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $dados = $request->all();
            $dados["msisdn"] = "55" . $dados["msisdn"];
            //Verifica se existe o password para encriptografar ela
            if (isset($dados["password"])) {
                $dados["password"] = $this->getHashPassword($dados["password"]);
            }
            $user = new User($dados);
            $user->save();
            $response = $this->integration->createUserMlearn($user);
            $user->id_mlearn = $response->data->id;
            $user->save();
            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    private function getHashPassword($password)
    {
        return Hash::make($password);
    }

    public function upgrade(User $user)
    {
        try {
            $response = $this->integration->upgradeUserMlearn($user);
            $dados = (array)$response->data;
            $dados["id_mlearn"] = $dados["id"];
            $dados["id"] = null;
            $user->update($dados);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function downgrade(User $user)
    {
        try {
            $response = $this->integration->downgradeUserMlearn($user);
            $dados = (array)$response->data;
            $dados["id_mlearn"] = $dados["id"];
            $dados["id"] = null;
            $user->update($dados);
        } catch (Exception $e) {
            return $e;
        }
    }
}
