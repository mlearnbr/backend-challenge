<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    function listUsers(){
        return view('users/list-users');
    }

    function newUser(){
        return view('users/create-user');
    }

    function createUser( Request $request ){
        dd($request->all());
    }
}
