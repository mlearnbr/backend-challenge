<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Http\Services\UserServices;

class UserList extends Component
{
    public $users;

    public function upgrade($access_id)
    {

    }

    public function downgrade($access_id)
    {

    }

    public function mount()
    {
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.user-list');
    }
}
