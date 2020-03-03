<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'tb_users';
    protected $fillable = ['name', 'msisdn', 'access_level'];
    protected $primaryKey = 'id';
}
