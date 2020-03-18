<?php

namespace App\Http\Controllers;

use App\Jobs\CreateUserMLearn;
use App\Jobs\DowngradeUserMLearn;
use App\Jobs\UpgradeUserMLearn;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;

class UserController extends Controller
{
    //

    public function createUser(Request $request)
    {
        $responseItens = ['response' => ['status' => false], 'code' => 400];

        if (
            isset($request->cellphone) &&
            isset($request->name) &&
            isset($request->password)
        ) {
            $user = new User;
            $user['msisdn'] = $request->cellphone;
            $user['name'] = $request->name;
            $user['access_level'] = "free";
            $user['password'] = $request->password;
            $success = $user->save();
            CreateUserMLearn::dispatchNow($user);

            if ($success) {
                $responseItens['response'] = ['status' => true];
                $responseItens['code'] = 201;
            }
        }

        return response()->json($responseItens['response'], $responseItens['code']);
    }

    public function listUsers()
    {
        $users = DB::table('users')
            ->select([
                'id',
                DB::raw('msisdn AS cellphone'),
                'name',
                DB::raw('access_level AS level')
            ])->get();
        return response()->json($users);
    }

    public function upgradeUser(Request $request)
    {
        $responseItens = ['response' => ['status' => false], 'code' => 400];

        if (isset($request->id)) {
            $user = User::find($request->id);
            if (isset($user->id)) {
                $user['access_level'] = 'premium';
                $success = $user->save();
                UpgradeUserMLearn::dispatchNow($user);

                if ($success) {
                    $responseItens['response'] = ['status' => true];
                    $responseItens['code'] = 200;
                }
            }
        }

        return response()->json($responseItens['response'], $responseItens['code']);
    }

    public function downgradeUser(Request $request)
    {
        $responseItens = ['response' => ['status' => false], 'code' => 400];

        if (isset($request->id)) {
            $user = User::find($request->id);
            if (isset($user->id)) {
                $user['access_level'] = 'free';
                $success = $user->save();
                DowngradeUserMLearn::dispatchNow($user);

                if ($success) {
                    $responseItens['response'] = ['status' => true];
                    $responseItens['code'] = 200;
                }
            }
        }

        return response()->json($responseItens['response'], $responseItens['code']);
    }
}
