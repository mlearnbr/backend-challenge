<?php
namespace App\Helpers;

use Illuminate\HttpRequest;

class ApiMLearnHelper
{
    public static function createUser($user)
    {                        
        
        $obj = [
            "msisdn" => $user->msisdn,
            "name" => $user->name,
            "access_level" => $user->access_level,
            "password" => $user->password,
            "external_id" => $user->id
        ];            
        
        $headers =  array(          
            'cache-control: no-cache',
            'content-type: application/json',
            'app-users-group-id: ' . env('MLEARN_APP_USERS_GROUP_ID'),
            'service-id: ' . env('MLEARN_SERVICE_ID'),
            'authorization: ' . env('MLEARN_AUTH')
        );

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => env('MLEARN_BASE_URL').'/integrator/'.env('MLEARN_SERVICE_ID').'/users',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode($obj),
          CURLOPT_HTTPHEADER => $headers,
        ));
         return curl_exec($curl);    
    }

    public static function upgradeDowngrade($user_id, $type)
    {                                 
        $headers =  array(          
            'cache-control: no-cache',
            'content-type: application/json',
            'app-users-group-id: ' . env('MLEARN_APP_USERS_GROUP_ID'),
            'service-id: ' . env('MLEARN_SERVICE_ID'),
            'authorization: ' . env('MLEARN_AUTH')
        );

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => env('MLEARN_BASE_URL').'/integrator/'.env('MLEARN_SERVICE_ID').'/users/'.$user_id.'/'.$type ,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "PUT",          
          CURLOPT_HTTPHEADER => $headers,
        ));
         return curl_exec($curl); 
    }    
}
