<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class APIServiceProvider extends ServiceProvider
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api2.mlearn.mobi',
            'headers' => [
                'Authorization' => env("API_AUTHORIZATION"),
                'service-id'     => env("SERVICE_ID"),
                'app-users-group-id'      => env("APP_USERS_GROUP_ID")
        ]]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function createUser( $user ){
        try{
            $res = $this->client->request('POST', '/integrator/'. env("SERVICE_ID") .'/users',[
                'form_params' => [
                    'name' => $user->name,
                    'msisdn' => $user->msisdn,
                    'access_level'  => $user->access_level,
                    'password ' => $user->password,
                    'external_id' => $user->id
                ]
            ]);
            return ($res->getBody());
        }catch (Exception $e){
            return($e);
        }
    }

    function upgradeUser($id){
        try{
            $res = $this->client->request('PUT', '/integrator/'. env("SERVICE_ID") .'/users/'. $id .'/upgrade');
            return $res->getBody();
        }catch (Exception $e){
            return($e);
        }
    }
    
    function downgradeUser($id){
        try{
            $res = $this->client->request('PUT', '/integrator/'. env("SERVICE_ID") .'/users/'. $id .'/downgrade');
            return $res->getBody();
        }catch (Exception $e){
            return($e);
        }
    }
}
