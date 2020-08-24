<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class User extends Model
{
    use Uuids;

    protected $guarded = [];
}