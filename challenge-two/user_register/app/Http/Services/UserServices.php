<?php 

namespace App\Http\Services;

use App\Models\User;
use App\Http\Apis\MLearnApi;

class UserServices {

    public static function mlearn()
    {
        return new MLearnApi();
    }

    public static function create($user)  
    {
        $user = User::create($user);
 
        if ( $user ) {
            $response = self::mlearn()->activateUser($user->toArray());

            if ( isset($response->json()['data']['id'])) {
                $user->access_id = $response->json()['data']['id'];
                $user->activate = true;
                $user->save();

                return $user;
            }
        }

        $user->delete();
        return false;
    }  
    
    public static function updagreAccount($access_id)  
    {
        $response = self::mlearn()->upgradeAccount($access_id);

        if ( $response->json()['data']['id']) {
            $user = User::where('access_id', $access_id)->first();
            $user->account = $response->json()['data']['access_level'];
            $user->save();
        }

        return $user;
    }  

    public static function downgradeAccount($access_id)  
    {
        $response = self::mlearn()->downgradeAccount($access_id);

        if ( $response ) {
            $user = User::where('access_id', $access_id)->first();
            $user->account = $response->json()['data']['access_level'];
            $user->save();
        }

        return $user;
    }  
}