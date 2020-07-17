<?php 

namespace App\Service;
use GuzzleHttp\Client;
use App\User;

class Api{ 
   private $groupId;
   private $client;
  
   public function __construct(){
   	$this->groupId = 20;
   	$this->client = new Client();
   }	
  
   public function store(User $dados):bool{
   	 try{
   	   $resp = $this->client->request(METHOD['post'], 
       HOST, 
       [
         'headers' => $this->getHeader(),
         'form_params' => $this->builtParams($dados)
       ]);    	
   	 }catch(\Exception $e){
       return false;	
   	 }
   	 return true;     
   }

  private function getHeader():array{
  	return [
      'Authorization' => 'Bearer '.TOKEN,
      'app-users-group-id' => $this->groupId,
      'Accept' => 'application/json'];
  }

  private function builtParams(User $dados):array{
    return [
      "name" => $dados->name,
      "msisdn" => $dados->msisdn,	  
	    "access_level" => $dados->access_level,
	    "password" => $dados->password,
      "external_id" => $dados->id	
    ];
  }

  public function show(User $user, $param="?msisdn=")
  :String{  	
      
  	  $res = $this->client->request(METHOD['get'], 
      HOST.$param.$user->msisdn, 
      ['headers' => $this->getHeader()]);  

      if($res->getStatusCode() == 200) 
        return $res->getBody()->getContents();      
  }

  public function update(array $dados):bool{
    try{
      $resp = $this->client->request(METHOD['put'], 
      HOST."/".$dados["external_id"], 
      [
        'headers' => $this->getHeader(),
        'form_params' => 
          $this->builtParams(User::find($dados['id']))
      ]);      
     }catch(\Exception $e){              
       return false;  
     }
     return true;   
  }

  public function destroy(array $dados):bool{     
    try{
      $res = $this->client->request(METHOD['delete'], 
      HOST."/".$dados["external_id"], 
      ['headers' => $this->getHeader()]);  
    }catch(\Exception $e){
      return false;  
    } 
    return true;      
  } 	
}