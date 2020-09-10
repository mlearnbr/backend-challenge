<?php
namespace App\AbstractClass;

abstract class AbstractApi{

    public function request(){
        try {
            $service_url = $this->url.$this->route.$this->service_id.$this->method;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $service_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $this->type_request,
                CURLOPT_POSTFIELDS  => $this->params,
                CURLOPT_HTTPHEADER => array(
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate",
                    "Authorization: Bearer " . $this->authorization_key,
                    "Cache-Control: no-cache",
                ),
            ));

            $response = curl_exec($curl);
            var_dump($response);die;
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                $result = "cURL Error #:" . $err;
            } else {
                $result = $response;
            }
            return $result;
        }catch (\Exception $e){
            var_dump($e);
        }
    }
}
