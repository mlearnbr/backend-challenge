<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserMLearn;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class UserMLearnController extends Controller
{
    public function __construct(UserMLearn $userMLearn, Request $request)
    {
        $this->model = $userMLearn;
        $this->request = $request;
        $this->hostMLearn = 'https://api2.mlearn.mobi/';
        $this->serviceId = 'qualifica';
        $this->headers = [
            'Content-Type'       => 'application/json',
            'Authorization'      => 'Bearer aSE1gIFBKbBqlQmZOOTxrpgPKgQkgshbLnt1NS3w',
            'service-id'         => $this->serviceId,
            'app-users-group-id' => 20
        ];
    }

    public function index()
    {
        $data = $this->model->all();
        return $data;
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->model->rules());

        $dataForm = $request->all();

        $dataForm['external_id'] = Str::random(8);

        $data = $this->model->create($dataForm);

        if ($data) {
            $url = $this->hostMLearn . 'integrator/' . $this->serviceId . '/users';

            $clientMlearn = new Client([
                'headers' => $this->headers
            ]);

            $myBody = [
                "msisdn"       => $data->msisdn,
                "name"         => $data->name,
                "access_level" => $data->access_level,
                "password"     => $data->password,
                "external_id"  => $data->external_id
            ];

            try {
                $resp   = $clientMlearn->post($url, ['body' => json_encode($myBody)]);
                $contents = json_decode($resp->getBody()->getContents());

                $data->mlearn_id = $contents->data->id;
                $data->save();

                $status = $resp->getStatusCode();

                if ($status != 200) throw new exception($status);
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
            if ($status === 200) {
                return response()->json(['sucesso' => $data]);
            } else {
                return response()->json(['error' => 'erro!']);
            }
        }
    }

    public function update($id)
    {
        if ($data = $this->model->find($id)) {

            $uri = $this->hostMLearn . 'integrator/' . $this->serviceId . '/users/' . $data->mlearn_id . '/upgrade';

            $clientMlearn = new Client([
                'headers' => $this->headers
            ]);

            try {
                $resp   = $clientMlearn->put($uri);
                $statusCode = $resp->getStatusCode();

                if ($statusCode != 200) throw new exception($statusCode);
            } catch (Exception $e) {
                $error = $e->getMessage();
            }

            if ($statusCode === 200) {
                return response()->json(['success' => 'Upgrade realizado com sucesso']);
            } else {
                return response()->json(['error' => 'Não foi possível realizar o upgrade do usuário']);
            }
        } else {
            return response()->json(['error' => 'user_not_found'], 404);
        }
    }

    public function destroy($id)
    {
        if ($data = $this->model->find($id)) {

            $uri = $this->hostMLearn . 'integrator/' . $this->serviceId . '/users/' . $data->mlearn_id . '/downgrade';

            $clientMlearn = new Client([
                'headers' => $this->headers
            ]);

            try {
                $resp   = $clientMlearn->put($uri);
                $statusCode = $resp->getStatusCode();

                if ($statusCode != 200) throw new exception($statusCode);
            } catch (Exception $e) {
                $error = $e->getMessage();
            }

            if ($statusCode === 200) {
                return response()->json(['success' => 'Downgrade realizado com sucesso']);
            } else {
                return response()->json(['error' => 'Não foi possível realizar o downgrade do usuário']);
            }
        } else {
            return response()->json(['error' => 'user_not_found'], 404);
        }
    }
}
