<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use App\Services\Contracts\IUserService;
use App\Models\User;
use Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    protected $userService;

    public function __construct
    (
        IUserService $userService
    )
    {
        $this->userService = $userService;
    }


    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(User::select('*'))
            ->addColumn('action', 'users.users-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

         try{

             $data = $this->userService->list();
             return UserResource::collection($data);

         } catch (\Exception $e) {
             return response()->json(
                 [
                     'success' => false,
                     'error' => $e->getMessage()
                 ],
                 403
             );
         }
    }


    public function store(UserRequest $request)
    {

        try{
            DB::beginTransaction();

            $data = (object)$request->only([
                'name',
                'msisdn',
                'password' ,
                'access_level',
                'external_id'
            ]);

            $data = $this->userService->add($data->name,$data->msisdn,$data->password,$data->access_level,$data->external_id);

            DB::commit();

            return $data;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);

            return response()->json(
                [
                    'success' => false,
                    'error' => $e->getMessage()
                ],
                403
            );
        }

    }


    public function show($id)
    {
        try{

            $data = $this->userService->listBy($id);
            return new UserResource($data);

        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $e->getMessage()
                ],
                403
            );
        }
    }


    public function update(UserRequest $request)
    {

        try{

            $data = (object)$request->only([
                'id',
                'name',
                'msisdn',
                'password' ,
                'access_level',
                'external_id'
            ]);

            $data = $this->userService->edit($data->id,$data->name,$data->msisdn,$data->password,$data->access_level,$data->external_id);
            return $data;

        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $e->getMessage()
                ],
                403
            );
        }

    }

    public function destroy(Request $request)
    {
        try{

            $data = (object)$request->only([
                'id'
            ]);

            $data = $this->userService->delete($data->id);
            return $data;

        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $e->getMessage()
                ],
                403
            );
        }
    }

}
