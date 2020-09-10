<?php

namespace App;

use App\AbstractClass\AbstractApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ServicesApi extends AbstractApi
{
    private $usuarios;
    protected $url;
    protected $service_id;
    protected $authorization_key;
    protected $user_group_id;
    protected $params;
    protected $route;
    protected $method;
    protected $type_request;

    public function __construct()
    {
        $this->usuarios = new Usuarios();
        $this->url = "https://api.mlearn.mobi/";
        $this->service_id = "/qualifica";
        $this->authorization_key = "aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w";
        $this->user_group_id = 20;
    }


    public function apiAddUser($user){
        $this->route = "/integrator";
        $this->method = "/users";
        $this->type_request = "POST";
        if ($user){
            $this->params['msisdn'] = $user['nu_telefone'];
            $this->params['name'] = $user['ds_nome'];
            $this->params['access_level'] = "free";
            $this->params['external_id'] = $user['id'];
            $this->params['password'] = $user['ds_password'];
            $this->request();

            return true;
        }else{
            return false;
        }

    }

}
