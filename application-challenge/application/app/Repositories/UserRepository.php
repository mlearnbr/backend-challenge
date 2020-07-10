<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Validators\UserValidator;


class UserRepository extends BaseRepository
{
    
    public function model()
    {
        return User::class;
    }

    public function search()
    {
        
        $results = $this->model->when(!empty(request()->name), function($query){
            return $query->where('name', 'like', '%'.request()->name.'%');
        })->paginate(1);

        return $results;
    }

    
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
