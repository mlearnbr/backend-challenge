<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\MlearnApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    public function new()
    {
        return view('register-user');
    }

    public function create(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'unique:users'],
            'phone' => ['required', 'string'],
            'name' => ['required', 'string'],
            'access_level' => ['required', 'string'],
        ]);

        DB::beginTransaction();
        $user = new User;
        $user->fill($request->input());
        $user->uuid = Uuid::uuid4();
        $user->save();

        $service = new MlearnApiService();
        $service->registerUser($user);
        DB::commit();

        return redirect()->to('/');
    }

    public function upgrade(Request $request)
    {
        $user = User::where('email', $request->user)->first();
        if (!$user || $user->access_level === 'premium') {
            return redirect()->back();
        }

        $apiService = new MlearnApiService();
        $apiService->upgradeUser($user);
        $user->access_level = 'premium';
        $user->save();

        return redirect()->to('/');
    }

    public function downgrade(Request $request)
    {
        $user = User::where('email', $request->user)->first();
        if (!$user || $user->access_level === 'pro') {
            return redirect()->back();
        }

        $apiService = new MlearnApiService();
        $apiService->downgradeUser($user);
        $user->access_level = 'pro';
        $user->save();

        return redirect()->to('/');
    }
}
