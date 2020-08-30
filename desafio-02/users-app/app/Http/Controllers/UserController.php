<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Database\QueryException;
use GuzzleHttp\Client;

class UserController extends Controller
{
    private $client;
    private $mLearnHost;
    private $mLearnServiceId;
    private $mLearnAppGroupId;
    private $mLearnToken;
    private $headers;

    public function __construct()
    {
        $this->mLearnHost = config('api.mlearn_host') . "integrator/";
        $this->mLearnToken = config('api.mlearn_token');
        $this->mLearnServiceId = config('api.mlearn_service_id');
        $this->mLearnAppGroupId = config('api.mlearn_group');
        $this->headers = [
            'Authorization' => 'Bearer '.$this->mLearnToken,
            'service-id' => $this->mLearnServiceId,
            'app-users-group-id' => $this->mLearnAppGroupId
        ];
        $this->client = new Client([
            'base_uri' => $this->mLearnHost,
            'verify' => false,
            'headers' => $this->headers
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        // Return collection of users as a resource
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());
        } catch (QueryException $e) {
            $errorInfo = $e->errorInfo;
            return $errorInfo;
        }

        // Sending post request to mLearn API
        $myBody = [
            'msisdn' => $user->msisdn,
            'name' => $user->name,
            'access_level' => $user->access_level,
            'password' => $user->password,
            'external_id' => $user->id
        ];
        $request = $this->client->request('POST', $this->mLearnServiceId."/users",  [
            'form_params' => $myBody
        ]);
        //$response = $request->getBody()->getContents();
        //return $response;
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        $myBody = [
            'msisdn' => $request->msisdn,
            'external_id' => $id
        ];
        $request = $this->client->request('GET', $this->mLearnServiceId."/users?external_id=".$id,  [
            'form_params' => $myBody
        ]);
        $response = json_decode($request->getBody());
        $mLearn_id = $response->data->id;
        if ($user->access_level == 'free') {
            // downgrade
            $request = $this->client->request('PUT', $this->mLearnServiceId."/users"."/".$mLearn_id."/downgrade");
            /* $response = $request->getBody()->getContents();
            return $response; */
        } else {
            // upgrade
            $request = $this->client->request('PUT', $this->mLearnServiceId."/users"."/".$mLearn_id."/upgrade");
            /* $response = $request->getBody()->getContents();
            return $response; */
        }

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return new UserResource($user);
    }
}
