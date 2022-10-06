<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
//        dd($this);
        $this->sanitize();
        return [
            'name' => 'required',
            'msisdn' => 'required|unique:users,msisdn' . $this->uniqueMsisdn(),
            'access_level' => 'required',
            'password' => 'nullable',
        ];
    }

    private function sanitize()
    {
        $input = $this->all();

        $input['msisdn'] = preg_replace('/[^0-9\\\+]/', '', $input['msisdn']);

        $this->replace($input);
    }

    private function uniqueMsisdn()
    {
        return ($id = optional($this->route('user'))->id) ? ",{$id}" : "";
    }
}
