<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\User\Validate as UserValidate;
use App\Http\Requests\User\UpdateValidate;
use App\User;
use App\Service\UserHelper;
use App\Service\Api;


class UsersController extends Controller
{
    public function index():object{
      $userList = (new User())->list();
      $levels = (new User())->levels(); 
      $helper = (new UserHelper());    

      return view('user.index', 
         compact('userList', 'levels', 'helper'));
    }

    public function create():object{
      return view('user.create');    
    }
    
    public function store(UserValidate $req){       
       $dados = $req->all();
       $dados['password'] = Hash::make($req->password);

       $insert = (new User())->store_u($dados);
       
       if($insert)
         $respApi = (new Api())->store(
           (new User())->takeLastUser());
       
         if(isset($respApi))
           return redirect()->route('user.index') 
           ->with('success', STORE_SUCCESS);

       return redirect()->route('user.create') 
       ->with('error', STORE_ERROR);
    }    
    
    public function edit($id):object{
       $user = User::find($id);
       $levels = (new User())->levels();

       return view('user.edit', 
        compact('user', 'levels'));
    }

    public function update(UpdateValidate $req, int $id)
    :object {

      $seekApi = (new Api())->show(User::find($id));
      $user = json_decode($seekApi, true)['data'];
      
      $dados = $req->except('_token');
      $dados['id'] = $id;
      $dados['external_id'] = $user['id']; 

      $update = (new User())->update_u($dados);            

      if($update)
        $respApi = (new Api())->update($dados);

      if(isset($respApi))
        return redirect()->route('user.index') 
        ->with('success', UPDATE_SUCCESS);

      return redirect()->route('user.index') 
      ->with('error', UPDATE_ERROR);
    }
    
    public function destroy(int $id):object{      
      $seekApi = (new Api())->show(User::find($id));
      $user = json_decode($seekApi, true)['data'];
      
      $delete = (new User())->destroy_u($id); 

      if($delete)
        $respApi = (new Api())->destroy($user);

      if(isset($respApi))
        return redirect()->route('user.index') 
        ->with('success', DELETE_SUCCESS);

      return redirect()->route('user.index') 
      ->with('error', DELETE_ERROR);
    }

    public function filter(Request $req):object{
      $helper = (new UserHelper());

      $dados = $req->all();
      if(isset($dados['msisdn']))
        $dados['msisdn'] = 
        $helper->formatMsisd($dados['msisdn']);
      
      $userList = (new User())->filter($dados);
      $levels = (new User())->levels();          

      return view('user.index', 
         compact('userList', 'levels', 'helper'));
    }

    public function show($id):object {      
      $seekApi = (new Api())->show(User::find($id));

      $user = json_decode($seekApi, true)['data'];
      $user = str_replace('+', '', $user);

      $helper = (new UserHelper());  
           
      return view('user.show', 
        compact('user', 'helper'));
    }    
}
