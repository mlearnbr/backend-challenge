<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'msisdn' => ['required', 'unique:users', 'regex:#\+[0-9]{13}#'],
            'name' => 'required',
            'access_level' => ['required', Rule::in(array_keys(config('enums.access_levels')))],
            'password' => ['nullable', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'msisdn.regex' => 'Telefone com formato inválido',
        ];
    }
}
