<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\MlearnApiService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $users = User::paginate();

        return view('index', ['users' => $users]);
    }
}
