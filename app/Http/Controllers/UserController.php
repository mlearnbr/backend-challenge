<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{ private $usuarios;

    public function __construct()
    {
        $this->usuarios = new Usuarios();
    }

    public function add(Request $request)
    {
        var_dump($request);die;
        $usuario = $this->usuarios->create([ 'no_usuario' => $request->no_usuario,]);
        \Session::flash('success',"Novo usuário cadastrado com sucesso!");
        if($usuario){
            return Redirect::to('/');
        }
    }
    public function view()
    {
        return view('user.view');
    }
}
