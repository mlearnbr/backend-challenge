<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class MainController extends Controller {
	public function storeItem(Request $request) {
		$data = new Data();
		$data->name = $request->name;
        $data->password = bcrypt($request->password);
        $data->msisdn = $request->msisdn;
        $data->access_level = $request->access_level;
		

        if($data->save()){
        
			$client = new Client;
			$externalID = "ML-010101-".$data->id;
			$response = $client->request('POST','https://api2.mlearn.mobi/integrator/qualifica/users', [
			    'headers' => [
			        'Authorization' => 'Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w',
			        'service-id'	=> 'qualifica',
			        'app-users-group-id' => '20',
			    ],
			    'form_params' => [ //form_params
		    	 	"msisdn" => $data->msisdn,
				 	"name" => $data->name,
				 	"access_level" => $data->access_level,
				 	"password" => $data->password,
				 	"external_id" => $externalID,
			    ],
			]);
			$idExternal = $response->getBody();
			//dd($idExternal->data->id);
			$data->ReturnJson = $response->getBody();
			//dd($data->ReturnJson->data->id);
			$data->save();
			//dd($dataResponse);
		}

		return "ok";
	}
	public function readItems() {
		$data = Data::all();
		return $data;
	}
	public function deleteItem(Request $request) {

		$data = Data::find( $request->id );
		$idExternoDel = json_decode($data->ReturnJson);
		
		$response = "";
		if(empty($response)){
			
			$data = Data::find( $request->id )->delete();

		}else{

			$client = new Client;
			$response = $client->request('DELETE',"https://api2.mlearn.mobi/integrator/qualifica/users/{$idExternoDel->data->id}", [
			    'headers' => [
			        'Authorization' => 'Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w',
			        'service-id'	=> 'qualifica',
			        'app-users-group-id' => '20',
			    ]
			]);
			$data = Data::find( $request->id )->delete();
		}
		
	}
	public function editItem(Request $request, $id){
		$data = Data::where('id', $id)->first();
		$idExternoDel = json_decode($data->ReturnJson);
		$data->access_level = $request->get('val_2');

		if($data->access_level == 'free'){

			$client = new Client;
			$response = $client->request('PUT',"https://api2.mlearn.mobi/integrator/qualifica/users/{$idExternoDel->data->id}/upgrade", [
			    'headers' => [
			        'Authorization' => 'Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w',
			        'service-id'	=> 'qualifica',
			        'app-users-group-id' => '20',
			    ]
			]);
			$data->save();

		}else{

			$client = new Client;
			$response = $client->request('PUT',"https://api2.mlearn.mobi/integrator/qualifica/users/{$idExternoDel->data->id}/downgrade", [
			    'headers' => [
			        'Authorization' => 'Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w',
			        'service-id'	=> 'qualifica',
			        'app-users-group-id' => '20',
			    ]
			]);
			$data->save();

		}
		return $data;
	}
}