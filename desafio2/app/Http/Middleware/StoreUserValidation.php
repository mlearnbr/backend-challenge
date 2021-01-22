<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;

class StoreUserValidation
{
    public function handle($request, Closure $next)
    {
        $data = $request->all();

        $rules = [
            'name' => ['required', 'min:1', 'max:255'],
            'msisdn' => [
                'required',
                'min:1',
                'max:255',
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
            'msisdn.required' => 'Informe o e-mail do usuário.',
            'msisdn.min' =>
                'O e-mail do usuário deve ter, no mínimo, 1 caractere.',
            'msisdn.max' =>
                'O e-mail do usuário deve ter, no máximo, 255 caracteres.',
            'msisdn.unique' =>
                'Já existe um usuário cadastrado com este e-mail. Verifique os dados informados e tente novamente.',
            'access_level.required' => 'Informe o nívl de acesso.',
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
}
