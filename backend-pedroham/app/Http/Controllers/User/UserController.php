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
            
            {//cadastro na base mLearn

                $host1         = 'https://api2.mlearn.mobi/';
                $host2         = 'https://api.mlearn.mobi/';
                $service_id    = 'qualifica';
                $authorization = 'Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w';

                $url = $host1.'integrator/'.$service_id.'/users';

                $headers = [
                            'Content-Type'       => 'application/json', 
                            'AccessToken'        => 'key', 
                            'Authorization'      => $authorization, 
                            'service-id'         => $service_id, 
                            'app-users-group-id' => 20
                        ];

                $client = new Client([
                    'headers' => $headers
                ]);

                $body = [
                    "msisdn"       => $user->msisdn,
                    "name"         => $user->name,
                    "access_level" => $user->access_level,
                    "password"     => "12345678910",
                    "external_id"  => $user->id
    
                ];

                try{
                    $response   = $client->post($url, [ 'body' => json_encode($body)]);

                    $contents = json_decode($response->getBody()->getContents());

                    $user->id_mlearn = $contents->data->id;
                    $user->save();

                    $statusCode = $response->getStatusCode();

                    if($statusCode != 200) throw new exception($statusCode);
                }
                catch(Exception $e){
                    $error = $e->getMessage();
                }

                if($statusCode === 200) {
                    DB::commit();
                    $notification = array(
                        'message'    => 'Sucesso!' , 
                        'alert-type' => 'success'
                    );
                }
                else {
                    $notification = array(
                        'message'    => $error, 
                        'alert-type' => 'error'
                    );
                    
                    DB::rollback();
                }
            }  
        }
        else DB::rollback();

        return redirect(route('get.users'))->with($notification);
    }

    public function deleteUser($id){

    }
    public function updateUser(Request $request){

    }

    public function upgradeUser($id){

        $user = $this->user->findOrFail($id);

        {//upgrade na base mLearn

                $host1         = 'https://api2.mlearn.mobi/';
                $host2         = 'https://api.mlearn.mobi/';
                $service_id    = 'qualifica';
                $authorization = 'Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w';

                $url = $host1.'integrator/'.$service_id.'/users/'.$user->id_mlearn.'/upgrade';

                $headers = [
                            'Content-Type'       => 'application/json', 
                            'AccessToken'        => 'key', 
                            'Authorization'      => $authorization, 
                            'service-id'         => $service_id, 
                            'app-users-group-id' => 20
                        ];

                $client = new Client([
                    'headers' => $headers
                ]);
                

                try{
                    $response   = $client->put($url);
                    $statusCode = $response->getStatusCode();

                    if($statusCode != 200) throw new exception($statusCode);
                }
                catch(Exception $e){
                    $error = $e->getMessage();
                }

                if($statusCode === 200) {
                    DB::commit();
                    $notification = array(
                        'message'    => 'Sucesso!' , 
                        'alert-type' => 'success'
                    );
                }
                else {
                    $notification = array(
                        'message'    => $error, 
                        'alert-type' => 'error'
                    );
                }

                 return redirect(route('get.users'))->with($notification);

            }  
    }
    public function downgradeUser($id){

        $user = $this->user->findOrFail($id);

        {//downgrade na base mLearn

            $host1         = 'https://api2.mlearn.mobi/';
            $host2         = 'https://api.mlearn.mobi/';
            $service_id    = 'qualifica';
            $authorization = 'Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w';

            $url = $host1.'integrator/'.$service_id.'/users/'.$user->id_mlearn.'/downgrade';

            $headers = [
                        'Content-Type'       => 'application/json', 
                        'AccessToken'        => 'key', 
                        'Authorization'      => $authorization, 
                        'service-id'         => $service_id, 
                        'app-users-group-id' => 20
                    ];

            $client = new Client([
                'headers' => $headers
            ]);
            try{
                $response   = $client->put($url);
                $statusCode = $response->getStatusCode();

                if($statusCode != 200) throw new exception($statusCode);
            }
            catch(Exception $e){
                $error = $e->getMessage();
            }

            if($statusCode === 200) {
                DB::commit();
                $notification = array(
                    'message'    => 'Sucesso!' , 
                    'alert-type' => 'success'
                );
            }
            else {
                $notification = array(
                    'message'    => $error, 
                    'alert-type' => 'error'
                );
            }

            return redirect(route('get.users'))->with($notification);
        }  
    }
}
