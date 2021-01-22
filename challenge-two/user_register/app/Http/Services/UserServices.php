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

        return $user;
    }  
    
    public static function updagreAccount($access_id)  
    {

    }  

    public static function downgradeAccount($user)  
    {

    }  
}