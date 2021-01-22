<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

        Validator::make($data, $rules, $messages)->validate();

        return $next($request);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'access_level' => $data['access_level'],
            'msisdn' => $data['msisdn'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
