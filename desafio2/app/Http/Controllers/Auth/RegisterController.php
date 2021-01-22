<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\NotificationHelper;
use App\Helpers\ApiMLearnHelper;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {      
        $rules = [
            'name' => ['required', 'min:1', 'max:255'],
            'msisdn' => [
                'required',
                'min:13',
                'max:14',
                'unique:users,msisdn,NULL,id,deleted_at,NULL',
            ],
            'access_level' => ['required'],
            'password' => ['required', 'min:6', 'max:64', 'confirmed'],
        ];

        $messages = [
            'name.required' => 'Informe o nome do usuário.',
            'name.min' => 'O nome do usuário deve ter, no mínimo, 1 caractere.',
            'name.max' =>
                'O nome do usuário deve ter, no máximo, 255 caracteres.',
            'msisdn.required' => 'Informe o fone(msisdn) do usuário.',
            'msisdn.min' =>
                'O fone(msisdn) do usuário deve ter, no mínimo, 13 caractere.',
            'msisdn.max' =>
                'O fone(msisdn) do usuário deve ter, no máximo, 14 caracteres.',
            'msisdn.unique' =>
                'Já existe um usuário cadastrado com este fone(msisdn). Verifique os dados informados e tente novamente.',
            'access_level.required' => 'Informe o nível de acesso.',
            'password.required' => 'Informe a senha do usuário',
            'password.min' =>
                'A senha do usuário deve ter, no mínimo, 6 caracteres.',
            'password.max' =>
                'A senha do usuário deve ter, no máximo, 64 caracteres.',
            'password.confirmed' =>
                'A senha e a confirmação de senha não coincidem.',
        ];

        return Validator::make($data, $rules, $messages);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {        
        $data['password'] = Hash::make($data['password']);

        try {
            DB::beginTransaction();
            $user = User::create($data);

            $user->save();

            $responseApi = json_decode(ApiMLearnHelper::createUser($user));            
            
            if(isset($responseApi->status_code) && ($responseApi->status_code == 400 || $responseApi->status_code == 422)){                 
                throw new Exception();
            }else{

                $user->user_id = $responseApi->data->id;

                $user->save();

                DB::commit();
                NotificationHelper::sendNotification(
                    'success',
                    'Usuário adicionado com sucesso.'
                );

                return $user;
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
}
