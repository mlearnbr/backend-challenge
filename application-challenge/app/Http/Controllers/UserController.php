<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{

    private $endpoint;
    private $user;

    public function __construct(User $user)
    {
        $this->endpoint = env('MLEARN_HOST') . "integrator/" . env('MLEARN_SERVICE_ID');
        $this->user = $user;
    }

    /**
     * Save user data
     * 
     * @param $request
     * 
     */
    public function save(Request $request)
    {
        $validate = $request->validate([
            'msisdn' => 'required|numeric',
            'password' => 'required'
        ]);

        //Making a hashed password
        $request->password = Hash::make($request->password);


        $userData = $request->all();
        
        //Save user data
        try {

            //Create user in local database
            $user = $this->user->create($userData);

            //Fill the data to send to mLearn
            $data = [
                'name' => $user->name,
                'msisdn' => $user->msisdn,
                'access_level' => $user->access_level,
                'external_id' => $user->id
            ];

            //Create user in mlearn database
            $response = self::saveUserApi($data);
            
            //Update user in local database with 'external_id'
            self::update($user->id, ['external_id' => $response['json']['data']['id']]);
    
            //return $user;
        } catch (\Exception $e) {
            return 'Message insert: ' . $e->getMessage() . '\n Error code: ' . $e->getCode();
        }        
    }

    /**
     * Update user in the 
     */
    public function update($id, $data, $origin = "")
    {
        try {
            if($origin == "mlearn")
                $user = $this->user->where('external_id', $id)->first();
            else
                $user = $this->user->where('id', $id)->first();

        
            $user->fill($data);
    
            $user->save();
    
            return $user;
        } catch (\Exception $e) {
            return 'Message update: ' . $e->getMessage() . '\n Error code: ' . $e->getCode();
        }
    }

    /**
     * Save user data on mLearn endpoint
     * 
     * @param array $data
     * 
     * @return json
     */
    private function saveUserApi($data)
    {
        $url = $this->endpoint . 'users';

        return \mLearnPostRequest($url, $data);
    }

    /**
     * set downgrade option to update user level on mlearn endpoint
     * 
     * @param int $id
     */
    public function downgradeUserApi($id)
    {
        self::updateUserApi($id, "downgrade");    
    }

    /**
     * set upgrade option to update user level on mlearn endpoint
     * 
     * @param int $id
     */
    public function upgradeUserApi($id)
    {
        self::updateUserApi($id, "upgrade");
    }

    /**
     * update user on mLearn
     * 
     * @param int $id
     * @param string $option
     * 
     * @return json
     */
    public function updateUserApi($id, $option)
    {
        $url = $this->endpoint . 'users/' . $id . "/" . $option;

        //Update access_level from the user in the mlearn database
        $response = \mLearnPutRequest($url);
        
        //Update access_level in local database
        self::update($id, ['access_level' => $response['json']['data']['access_level']], 'mlearn');

        return response()->json([
            'data' => $response['success'] === true ? $response['json'] : "",
            'message' => $response['success'] === false ? $response['message'] : "",
            'code' => $response['success'] === false ? $response['code'] : ""
        ]);
    }
}
