<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Group;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
    'name', 'msisdn', 'access_level', 'password'];

    public function groups(){
      return $this->hasMany(Group::class);
    }        

    public function setMsisdnAttribute($msisdn):void{ 
     if(isset($msisdn))   
       $this->attributes['msisdn'] = 
       preg_replace('/[^0-9]/', '', $msisdn);     
    }     

    public function store_u(array $dados):bool{
      
      try{      	
        $this::create($dados);
      }catch(\Exception $e){
        return false;
      }      
      return true;         
   }    

   public function list():object{
     return $this::query()
     ->select('id', 'name', 'msisdn', 'access_level', 
              'updated_at')
     ->orderby('id', 'desc')
     ->get();
   }

   public function levels():array{
     return ['free', 'premium'];
   }

   public function update_u(array $dados):bool{
      $user = $this::find($dados['id']);
      
      try{
        $user->fill($dados);
        $user->save();
      }catch(\Exception $e){
        return false;  
      } 
      return true;
   } 

   public function destroy_u(int $id):bool{
      $user = $this::find($id);
      
      try{
        $user->delete($id);       
      }catch(\Exception $e){
        return false;
      }
      return true;  
   }

   public function filter(array $dados):object{      
      
      if(isset($dados['name']))
        return $this::where('name', 'like', 
        '%'.$dados['name'].'%')
        ->get();   

      if(isset($dados['msisdn']))       
        return $this::where('msisdn', 'like', 
        '%'.$dados['msisdn'].'%')
        ->get();

      return $this->list();   
   }  
 
   public function takeLastUser(){
     return $this::query()
     ->select('id', 'name', 'msisdn', 'access_level')
     ->orderby('id', 'desc')
     ->first();
   }       

 }
