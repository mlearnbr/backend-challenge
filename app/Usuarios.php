<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = "tb_usuarios";

    protected $fillable = [
        'no_usuario', 'ds_email', 'ds_password',
    ];

    protected $hidden = [
        'ds_password', 'remember_token',
    ];

    protected $casts = [
        'dt_email_verified_at' => 'datetime',
    ];
}
