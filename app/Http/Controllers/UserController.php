<?php

namespace App\Http\Controllers;

use App\ServicesApi;
use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    private $usuarios;
    private $api;

    public function __construct()
    {
        $this->usuarios = new Usuarios();
        $this->api = new ServicesApi();
    }

    public function add(Request $request)
    {
        var_dump($request);die;
        $arrUsuario = [
            'no_usuario' => $request->no_usuario,
            'ds_email' => $request->ds_email,
            'nu_telefone' => $request->nu_telefone,
            'ds_password' => Hash::make($request->ds_password),
            ];
        $usuario = $this->usuarios->create($arrUsuario);

        if($usuario) $apiUsuario = $this->treatAddUserApi($arrUsuario);

        \Session::flash('success',"Novo usuário cadastrado com sucesso!");
        if($apiUsuario){
            return Redirect::to('/');
        }
    }
    public function view()
    {
        return view('user.view');
    }

    private function treatAddUserApi($user){
        $userDB = DB::table('tb_usuarios')->where('ds_email',$user['ds_email'])->get();
        $this->api->apiAddUser($userDB);

    }
}
