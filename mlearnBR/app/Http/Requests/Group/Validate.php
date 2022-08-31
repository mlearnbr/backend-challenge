<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;

class Validate extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
      return [
        'user_id' => 'required | numeric',
        'group_id' => 'required| max:7',
        'title' => 'required| min:3| max:50'
      ];      
    }
}
