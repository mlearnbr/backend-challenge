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
        $user = UserServices::updagreAccount($access_id);
        $this->users->firstWhere('access_id', $access_id)->account = $user->account;
    }

    public function downgrade($access_id)
    {
        $user = UserServices::downgradeAccount($access_id);
        $this->users->firstWhere('access_id', $access_id)->account = $user->account;
    }

    public function mount()
    {
        $this->users = User::orderBy('id', 'DESC')->get();
    }

    public function render()
    {
        return view('livewire.user-list');
    }
}
