<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Group\Validate;
use App\Models\Group;
use App\Service\GroupApi;
use App\User;

class GroupsController extends Controller
{
    public function index():object{
      $groupList = (new Group())->list();
        
      return view('group.index', 
        compact('groupList')); 
    }

    public function create(int $user_id):object{       
       return view('group.create', 
        compact('user_id'));    
    }

    public function store(Validate $req):object{
      
      $insert = (new Group())->store_g($req->all());

      if($insert)         
        return redirect()->route('group.index') 
        ->with('success', STORE_SUCCESS);

      return redirect()->route('group.create') 
      ->with('error', STORE_ERROR);        
    }
}
