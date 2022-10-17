<?php

namespace App\Http\Requests\Aplication;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule as ValidationRule;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'msisdn' => ['required', 'regex:/\+[0-9]{13}/', 'max:14'],
            'name' => ['required', 'max:255'],
            'access_level' => ['required', ValidationRule::in(['pro', 'premium'])],
            'password' => ['nullable'],
        ];
    }
}
