<?php

namespace App;

use App\Http\Traits\Uuid;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'msisdn', 'access_level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function upgrade(): User
    {
        $this->access_level = 'premium';
        $this->save();
        return $this;
    }

    public function downgrade(): User
    {
        $this->access_level = 'free';
        $this->save();
        return $this;
    }

}
