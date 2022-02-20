<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Util\Xml\Exception;

class UserService
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $dados = $request->all();
            $dados["password"] = $this->getHashPassword($dados["password"]);
            $user = new User($dados);
            $user->save();
            DB::commit();
            return $user;
        }catch (Exception $e){
            DB::rollBack();
            return $e;
        }
    }

    private function getHashPassword($password)
    {
        return Hash::make($password);
    }
}
