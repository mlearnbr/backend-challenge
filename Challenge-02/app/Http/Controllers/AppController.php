<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    //
    public function appIndex(Request $request)
    {
        return view('index');
    }
}
