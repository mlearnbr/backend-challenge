<?php

if(! function_exists('mLearnHeaders')) {
    function mLearnHeaders()
    {
        return [
            'Authorization: Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w', 
            'service-id: qualifica', 
            'app-users-group-id: 20', 
            'Content-Type: application/json'
        ];
    }
}

if(! function_exists('mLearnGetRequest')) {
    function mLearnGetRequest(String $url, String $data)
    {
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url . '/?' . $data,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => mLearnHeaders()
            )
        );

        $content = curl_exec($curl);
        $error = curl_error($curl);
        $errno = curl_errno($curl);

        curl_close($curl);

        $json = json_decode($content, true);

        return $error . ' : ' . $errno || array_key_exists('status_code', $json) ? [
                                                                                   'success' => false, 
                                                                                   'message' => $error, 
                                                                                   'code' => $errno, 
                                                                                   'json' => $json
                                                                                   ] : 
                                                                                   [
                                                                                    'success' => true,
                                                                                    'message' => '',
                                                                                    'code' => '',
                                                                                    'json' => $json
                                                                                   ];
    }
}

if(! function_exists('mLearnPostRequest')) {
    function mLearnPostRequest(String $url, Array $data)
    {
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => mLearnHeaders()
            )
        );

        $content = curl_exec($curl);
        $error = curl_error($curl);
        $errno = curl_errno($curl);

        curl_close($curl);

        $json = json_decode($content, true);
        return $error . ' : ' . $errno || array_key_exists('status_code', $json) ? [
                                                                                   'success' => false, 
                                                                                   'message' => $error, 
                                                                                   'code' => $errno, 
                                                                                   'json' => $json
                                                                                   ] : 
                                                                                   [
                                                                                    'success' => true,
                                                                                    'message' => '',
                                                                                    'code' => '',
                                                                                    'json' => $json
                                                                                   ];
    }
}

if(! function_exists('mLearnPutRequest')) {
    function mLearnPutRequest(String $url)
    {
        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_HTTPHEADER => mLearnHeaders()
            )
        );

        $content = curl_exec($curl);
        $error = curl_error($curl);
        $errno = curl_errno($curl);

        curl_close($curl);

        $json = json_decode($content, true);

        return $error . ' : ' . $errno || array_key_exists('status_code', $json) ? [
                                                                                   'success' => false, 
                                                                                   'message' => $error, 
                                                                                   'code' => $errno, 
                                                                                   'json' => $json
                                                                                   ] : 
                                                                                   [
                                                                                    'success' => true,
                                                                                    'message' => '',
                                                                                    'code' => '',
                                                                                    'json' => $json
                                                                                   ];
    }
}