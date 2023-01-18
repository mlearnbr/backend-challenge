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
        'phone' => 'required|unique:users,phone',
        'pass' => 'required',
    ];

    public function submit()
    {
        $this->validate();

        $phone = str_replace('-', '', str_replace(' ', '', str_replace('(', '', str_replace(')', '', $this->phone))));
        
        if(strlen($phone) == 14 ) {
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
        
        $this->addError('phone', 'Phone number is invalid.');
    }

    public function render()
    {
        return view('livewire.user-register');
    }
}
