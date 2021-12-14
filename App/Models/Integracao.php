<?php

namespace App\Models;

class Integracao
{
    private $authorization;
    private $service_id;
    private $app_users_group_id;
    private $host;
    private $url;

    public function __construct()
    {
        $this->authorization = AUTHORIZATION_TYPE . ' ' . AUTHORIZATION;
        $this->service_id = SERVICE_ID;
        $this->app_users_group_id = APP_USER_GROUP_ID;
        $this->host = 'https://api.staging.mlearn.mobi';
    }

    public function upgradeMLeran($id, $tipo)
    {
        $curl = curl_init();
        $this->url =  '/integrator/' . $this->service_id . '/users/' . $id . '/' . $tipo;
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->host . $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $this->authorization,
                'service-id: ' . $this->service_id,
                'app-users-group-id: ' . $this->app_users_group_id
            ),
        ));

        $response = json_decode(curl_exec($curl));

        curl_close($curl);
        return $response;
    }
    public function cadastroMLeran($dados)
    {
        $this->url =  '/integrator/' . $this->service_id . '/users';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->host . $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $dados,
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $this->authorization,
                'service-id: ' . $this->service_id,
                'app-users-group-id: ' . $this->app_users_group_id,
                'Content-Type: application/json'
            ),
        ));

        $response = json_decode(curl_exec($curl));
        
        curl_close($curl);

        return $response->data;
    }
}
