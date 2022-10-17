<?php

namespace App\Service;

use App\Contract\DowngradeUserAPIInterface;
use App\Contract\StoreUserAPIInterface;
use App\Contract\UpgradeUserAPIInterface;
use App\DTO\DowngradeUserDTO;
use App\DTO\UpgradeUserDTO;
use Illuminate\Support\Facades\Http;

class DowngradeUserAPIService implements DowngradeUserAPIInterface{

    public function handle(DowngradeUserDTO $dataDTO)
    {
        $url = env('QUALIFICA_BASE_URL', 'https://api.staging.mlearn.mobi/'). 'integrator/'.env('QUALIFICA_SERVICE', 'qualifica'). '/users/'.$dataDTO->id.'/downgrade';
        
        $response = Http::withHeaders([
            'Authorization' => env('QUALIFICA_TOKEN', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiYzRhZWU3YmVlNjdmMGM3NzBlMzYzMjdiY2ZhOWEzNzNhNjhlNjA2OTY5MGYzYTJjOTM5YjhjOGQ2YjA4YmVmNjA4Y2Y2Mzg2M2RkZmI3MTAiLCJpYXQiOjE2NjQyMDIyMTIuODcyMTA2LCJuYmYiOjE2NjQyMDIyMTIuODcyMTA4LCJleHAiOjE2OTU3MzgyMTIuODY3NTUyLCJzdWIiOiIiLCJzY29wZXMiOlsid3JpdGU6bWFuYWdlX3VzZXJzIiwicmVhZDptYW5hZ2VfdXNlcnMiLCJ3cml0ZTppbnRlZ3JhdG9yX25vdGlmaWNhdGlvbnMiXX0.hGUkr0Wqla2yQjp9V5z371angsqhkoBmMidxSzgtxJ6Y0WWqN6pFPZ8RwqZxruu1EvHGG5u_nU901kYHOcCNK04C75bbjKqbnqPEkdjKqjktmdLucp6yypj3XmSyIodXbDipgMqptOHMgQOaNHWo8tl5KmA_H1m9bcDvc24tbgFKZG2QyZ3cg5W9HBsjZzcAwjEgm9rBu76uMpxgG7NzXBZvyFIzCvly14TGqGKG6jV_JJKGAK1AE2YTqnp79dqO99g_i_m_ZHs0RIKgnnbyl_Al_Vc5URN-xvHRiEMDs9AxPRZCXvh5B_RHoLuIg9O4gyUBKfADJ7SFSrGYccb03XQAEZrHqOTCSH9rZRxYr_0-SrldLTtBFlB2ybyQ1vM5w-1ZGl7ATEJF6Q-pxmeRoNdIPYc-S-OH9ZbYGO6jyhZEFdxcGHX_cW2979a_0fxBIdQ85aGtbyUorgwtexB0910HLC8WiMdkGEA3P_I7qGi6OTTBQ6YSrpSWxJ0_gSgG5D57wooschXd3ZFEBQbFfPnWQ7ooP-MLBL4iXdpicALOzeF4p2IC9GkQrQeFYbpX7m4txjJK2lTdtBCbI4LeREI2mU8JrrkmuaaHpdltHrYxpke6HOhQsoNMvuwvpawTaU832rmJTEWPgcfmB6QcjJHUcgbJ9wKOJ0sEcLqTxac'),
            'app-users-group-id' => env('QUALIFICA_GROUP_ID', 1),
        ])
        ->put($url);

        $status = $response->status();
        
        if($response->failed()){
            $response = $response->json();
            $response['success'] = false;
            return $response;
        }
        
        if($response->successful()){
            $response = $response->json();
            $response['success'] = true;
            $response['status'] = $status;
            return $response;
        }
    }
}