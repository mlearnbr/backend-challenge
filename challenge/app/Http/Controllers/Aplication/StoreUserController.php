<?php

namespace App\Http\Controllers\Aplication;

use App\Contract\StoreUserAPIInterface;
use App\Contract\StoreUserInterface;
use App\Contract\UpdateUserInterface;
use App\DTO\StoreUserAPIDTO;
use App\DTO\StoreUserDTO;
use App\DTO\UpdateUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Aplication\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class StoreUserController extends Controller
{
    /**
     *
     * @var StoreUserInterface
     */
    private StoreUserInterface $storeUser;

    /**
     *
     * @var StoreUserAPIInterface
     */
    private StoreUserAPIInterface $storeUserAPI;

    /**
     *
     * @var UpdateUserInterface
     */
    private UpdateUserInterface $update;

    public function __construct(StoreUserInterface $storeUser, StoreUserAPIInterface $storeUserAPI, UpdateUserInterface $update)
    {
        $this->storeUser = $storeUser;
        $this->storeUserAPI = $storeUserAPI;
        $this->update = $update;
    }


     /**
     *
     * @OA\Post(
     *     path="/api/user",
     *     tags={"User"},
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"name", "msisdn", "access_level"},
     *                 @OA\Property(
     *                     property="name",
     *                     example="Name",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="msisdn",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     example="password",
     *                     format="password",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="access_level",
     *                     type="string",
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Store successful", @OA\JsonContent()),
     *     @OA\Response(response="413", description="Store failed", @OA\JsonContent()),
     * )
     */
    public function __invoke(StoreRequest $request)
    {
        $request = $request->validated();

        $request['password'] = (isset($request['password']) && $request['password'] == '')? null: $request['password'];

        DB::beginTransaction();

        $userDTO = new StoreUserDTO($request);

        $user = $this->storeUser->handle($userDTO);

        if(!$user){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastra usuário, tente novamente mais tarde!',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $request['external_id'] = $user->id;

        $storeAPIDTO = new StoreUserAPIDTO($request);

        $response = $this->storeUserAPI->handle($storeAPIDTO);

        if(!$response['success']){
            DB::rollback();
            return response()->json($response);
        }

        $updateDTO = new UpdateUserDTO([
            'user' => $user,
            'data' => ['external_id' => $response['data']['id']],
        ]);

        $this->update->handle($updateDTO);        

        DB::commit();
        
        return response()->json([
            'success' => true,
            'message' => 'Cadastro realizado com sucesso!',
            'data' => $response,
        ], Response::HTTP_CREATED);
        
    }
}
