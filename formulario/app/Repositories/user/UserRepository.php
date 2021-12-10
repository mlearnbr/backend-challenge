<?php
namespace App\Repositories\user;

use App\Models\User;
use App\Repositories\Contracts\IUserRepository;
use App\Services\Contracts\IMLearnService;


class UserRepository  implements IUserRepository
{

    protected $user;
    protected $imlearnServ;

    public function __construct
    (
       User $user, IMLearnService $imlearnServ
    ) {
       $this->user = $user;
       $this->imlearnServ = $imlearnServ;
    }

    public function list()
    {
        return $this->user::paginate(10);
    }

    public function add(string $name, string $msisdn, ?string $password, string $access_level,string $external_id)
    {
        $result = $this->user::create([
            'name' => $name,
            'msisdn' => $msisdn,
            'password' => $password,
            'access_level' => $access_level,
            'external_id' => $external_id
        ]);

        $data = [
            'name' => $name,
            'msisdn' => $msisdn,
            'password' => $password,
            'access_level' => $access_level,
            'external_id' => $external_id
        ];

       // submit from api mlearn
       $mlearn =  $this->imlearnServ->addUser($data);

       //update mlearn_id from db local
       $result->update(['mlearn_id' => $mlearn->data->id]);

       return $result;
    }

    public function listBy(int $id)
    {
        $data =  $this->user::findOrFail($id);
        return $data;
    }

    public function edit(int $id,string $name, string $msisdn, ?string $password, string $access_level,string $external_id)
    {

           $obj =  $this->user::findOrFail($id);
           $obj->name = $name;
           $obj->msisdn = $msisdn;
           $obj->password = $password;
           $obj->access_level =  $access_level;
           $obj->external_id = $external_id;

           if( $obj->save() ){
            return  $obj;
          }
    }

    public function delete(int $id){

        $obj =  $this->user::findOrFail($id);

          if( $obj->delete() ){
           return  $obj;
         }
   }

}
