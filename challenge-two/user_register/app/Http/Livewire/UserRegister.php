<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Hash;
use App\Http\Services\UserServices;

class UserRegister extends Component
{   
    public $name;
    public $email;
    public $phone;
    public $pass;
    public $account = 'free';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|digits:14',
        'pass' => 'required',
    ];

    public function submit()
    {
        $this->validate();

        $user = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => str_replace('-', '', str_replace(' ', '', str_replace('(', '', str_replace(')', '', $this->phone)))),
            'password' => Hash::make($this->pass),
            'account' => $this->account
        ];

        $register = UserServices::create($user);
        
        if ( $register ) {
            redirect()->route('users.index');
        }        
    }

    public function render()
    {
        return view('livewire.user-register');
    }
}
