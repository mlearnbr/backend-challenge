<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use GuzzleHttp\Client;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function getUsers(){
        $user = $this->user->all();

        return view('users.users', compact('user'));
    }

    public function registerUser(){

        

        return view('users.createuser');
    }

    public function createUser(Request $request){
        DB::beginTransaction();

        $user = $this->user->create($request->all());

        if($user){ 
            DB::commit();
            {//cadastro na base mLearn
                

                $host1         = 'https://api2.mlearn.mobi/';
                $host2         = 'https://api.mlearn.mobi/';
                $service_id    = 'qualifica';
                $authorization = 'bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w';

                $url = $host1.'integrator/'.$service_id.'/users';

                $headers = ['Content-Type' => 'application/json', 'AccessToken' => 'key', 'Authorization' => $authorization, 'service-id' => $service_id, 'app-users-group-id' => 20];

                $client = new Client([
                    'headers' => $headers
                ]);

                $body = '{
                    "msisdn"       :'.$user->msisdn.',
                    "name"         :'.$user->name.',
                    "access_level" :'.$user->access_level.',
                    "password"     :'."123".',
                    "external_id"  :'.$user->id.'
    
                }';
                $response   = $client->post($url, [ 'body' => $body]);
                $statusCode = $response->getStatusCode();
                $message    = $response->getMessage();

                echo "<script> console.log(".$statusCode.",".$message.");</script>";
            }  
        }
        else DB::rollback();

        return redirect(route('get.users'));
    }

    public function deleteUser($id){

    }
    public function updateUser(Request $request){

    }

    public function upgradeUser($id){
        
    }
    public function downgradeUser($id){

    }
}
