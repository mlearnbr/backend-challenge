<?php

namespace App\Http\Controllers;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use App\User;

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
            'msisdn' => 'required',
            'access_level'  => 'required'
        ]);

        User::create($request->all());
        return redirect('/users');
    }
}
