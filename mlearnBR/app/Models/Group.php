<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Group extends Model
{
    protected $fillable = ['group_id', 'user_id', 'title'];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function setGroup_idAttribute($value):void{ 
      $this->attributes['group_id'] = 
      mb_strtoupper($value);  
    } 

    public function setTitleAttribute($value):void{ 
      $this->attributes['title'] = 
      mb_strtoupper($value);  
    }

    public function store_g(array $dados):bool{      
      try{      	
        $this::create($dados);
      }catch(\Exception $e){
        return false;
      }      
      return true;         
   }  

   public function list():object{
     return $this::query()
     ->select('id', 'group_id', 'title', 'user_id')
     ->orderby('id', 'desc')
     ->get();
   } 
}
