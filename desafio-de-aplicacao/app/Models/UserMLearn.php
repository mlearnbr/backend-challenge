<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMLearn extends Model
{
    protected $fillable = [
        'msisdn',
        'name',
        'access_level',
        'password',
        'external_id',
        'mlearn_id',
    ];

    public function rules($id = '')
    {
        $id = $this->id;
        return [
            'msisdn' => 'required',
            'name' => 'required',
            'access_level' => 'required',
        ];
    }
}
