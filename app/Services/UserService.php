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
            //Verifica se existe o password para encriptografar ela
            if (isset($dados["password"])) {
                $dados["password"] = $this->getHashPassword($dados["password"]);
            }
            $user = new User($dados);
            $user->save();
            $this->integration->createUserMlearn($user);
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
}
