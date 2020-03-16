<?php

namespace App\Http\Controllers;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use App\User;
use App\Providers\APIServiceProvider;

class UsersController extends Controller
{
    function listUsers(){
        $users = User::all();
        return view('users/list-users')->with('users', $users);;
    }

    function newUser(){
        return view('users/create-user');
    }

    function createUser( Request $request ){
        $request->validate([
            'name' => 'required',
            'msisdn' => 'required|unique:users,msisdn',
            'access_level'  => 'required'
        ]);
        // Persistindo o usuário na base de dados local
        $user = User::create($request->all());
        
        // Enviando o usuario para a API
        $api = new APIServiceProvider;
        $createdUser = json_decode($api->createUser($user));

        // Salvando o ID externo no banco local
        $user->external_id = $createdUser->data->id;
        $user->save();

        return redirect('/users');
    }

}
