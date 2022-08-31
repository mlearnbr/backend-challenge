<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class Validate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    
    public function rules(){
        return [
          'name' => 'required | min:3 | max:50',
          'password' => 'required| min:6| max:6| confirmed',
          'password_confirmation' => 'required| min:6| max:6'
        ];
    }
}
