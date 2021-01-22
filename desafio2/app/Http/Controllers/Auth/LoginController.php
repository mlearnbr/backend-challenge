<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helpers\NotificationHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        $data = $request->all();
        $remember = true;
        $rules = [
            'msisdn' => ['required', 'max:14', 'min:13',],
            'password' => ['required', 'max:255', 'min:6'],
        ];

        $messages = [
            'msisdn.required' => 'Informe o seu fone(msisdn).',
            'msisdn.max' => 'O seu fone(msisdn) deve ter, no máximo, 14 caracteres.',
            'msisdn.min' => 'O seu fone(msisdn) deve ter, no mínimo, 13 caractere.',
            'password.required' => 'Informe a sua senha.',
            'password.max' =>
                'A sua senha deve ter, no máximo, 255 caracteres.',
            'password.min' => 'A sua senha deve ter, no mínimo, 6 caracteres.',
        ];

        Validator::make($data, $rules, $messages)->validate();

        $user = User::where('msisdn', $data['msisdn'])
                    ->first();

                    
        if ($user) {

            $obj = [
                'msisdn' => $request->msisdn,
                'password' => $request->password,                                
            ];
            
            if (
                Auth::attempt($obj)
            ) {
                NotificationHelper::sendNotification(
                    'success',
                    'Login realizado com sucesso.'
                );

                return redirect('home');
                
            } else {
                NotificationHelper::sendNotification(
                    'error',
                    'msisdn e/ou senha incorreto(s).'
                );
                return back()->withInput();
            }
        } else {            
            NotificationHelper::sendNotification(
                'error',
                'Credenciais inválidas.'
            );

            return back()->withInput();
        }
    }
}
