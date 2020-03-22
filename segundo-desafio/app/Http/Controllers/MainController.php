<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use GuzzleHttp\Client;

class MainController extends Controller {
	public function storeItem(Request $request) {
		$data = new Data();
		$data->name = $request->name;
        $data->password = bcrypt($request->password);
        $data->msisdn = $request->msisdn;
        $data->access_level = $request->access_level;

		if($data->save()){
			$client = new GuzzleHttp\Client;
			$externalID = "ML-010101-".$data->id;
			$response = $client->post('https://api2.mlearn.mobi/integrator/qualifica/users', [
			    'headers' => [
			        'Authorization' => 'Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w',
			        'service-id'	=> 'qualifica',
			        'app-users-group-id' => '20',
			    ],
			    'form_params' => [
		    	 	"msisdn" => $data->msisdn,
				 	"name" => $data->name,
				 	"access_level" => $data->access_level,
				 	"password" => $data->password,
				 	"external_id" => $externalID,
			    ],
			]);

			$data = json_decode($response->getBody(), true);
		}

		return $data;
	}
	public function readItems() {
		$data = Data::all();
		return $data;
	}
	public function deleteItem(Request $request) {
		$data = Data::find( $request->id )->delete();
	}
	public function editItem(Request $request, $id){
		$data = Data::where('id', $id)->first();
		$data->access_level = $request->get('val_2');


        $data->save();
		return $data;
	}
}