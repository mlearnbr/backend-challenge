<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\NotificationHelper;
use App\Helpers\ApiMLearnHelper;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $users = User::All();
        return view('users.index', ['users' => $users]);        
    }

    public function create(Request $request)
    {                
        return view('users.form');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        
        try {
            DB::beginTransaction();
            $user = User::create($data);

            $user->save();

            $responseApi = json_decode(ApiMLearnHelper::createUser($user));            

            if(isset($responseApi->status_code)){            
                throw new Exception();
            }else{

                $user->user_id = $responseApi->data->id;

                $user->save();

                DB::commit();
                NotificationHelper::sendNotification(
                    'success',
                    'Usuário adicionado com sucesso.'
                );

                return redirect('users');
            }
        } catch (Exception $e) {                              
            DB::rollback();
            NotificationHelper::sendNotification(
                'error',
                'Não foi possível adicionar este usuário. Verifique os dados informados e tente novamente!'
            );

            return back()->withInput();
        }
    }   

    public function upgrade($id)
    {

        $user = User::find($id);
        $data['access_level'] = 'premium';

        try {
            DB::beginTransaction();
            $user->update($data);

            $responseApi = json_decode(ApiMLearnHelper::upgradeDowngrade($user->user_id, 'upgrade'));             

            if(isset($responseApi->status_code)){            
                throw new Exception();
            }else{

                DB::commit();
                NotificationHelper::sendNotification(
                    'success',
                    'Upgrade de Usuário executado com sucesso.'
                );

                return redirect('users');
            }
        } catch (Exception $e) {            
            DB::rollback();
            NotificationHelper::sendNotification(
                'error',
                'Não foi possível fazer o upgrade deste usuário. Verifique os dados informados e tente novamente!'
            );

            return back()->withInput();
        }
    }

    public function downgrade($id)
    {

        $user = User::find($id);
        $data['access_level'] = 'free';

        try {
            DB::beginTransaction();
            $user->update($data);

            $responseApi = json_decode(ApiMLearnHelper::upgradeDowngrade($user->user_id, 'downgrade'));                        
            if(isset($responseApi->status_code)){            
                throw new Exception();
            }else{

                DB::commit();
                NotificationHelper::sendNotification(
                    'success',
                    'Downgrade de Usuário executado com sucesso.'
                );

                return redirect('users');
            }
        } catch (Exception $e) {            
            DB::rollback();
            NotificationHelper::sendNotification(
                'error',
                'Não foi possível fazer o downgrade deste usuário. Verifique os dados informados e tente novamente!'
            );

            return back()->withInput();
        }
    }
       
}
