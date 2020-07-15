<?php

namespace App\Http\Requests\User;

use App\Interfaces\User\CreateUserInterface;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest implements CreateUserInterface
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
            'name' => 'required',
            'password' => 'required',
            'email' => ['required', 'unique:users.email'],
            'accessLevel' => Rule::in(User::FREE_ACCESS, User::PREMIUM_ACCESS),
            'phone' => ['required', 'min:11', 'max:11']
        ];
    }

    public function getName(): string
    {
        return $this->get('name');
    }

    public function getPhone(): string
    {
        return $this->get('phone');
    }

    public function getEmail(): string
    {
        return $this->get('email');
    }

    public function createPassword(): string
    {
        return password_hash($this->get('password'), PASSWORD_BCRYPT);
    }

    public function getOriginalPassword(): string
    {
        return $this->get('password');
    }

    public function getAccessLevel(): ?string
    {
        return $this->get('accessLevel');
    }
}
