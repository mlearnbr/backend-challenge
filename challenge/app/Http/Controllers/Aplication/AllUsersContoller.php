<?php

namespace App\Http\Controllers\Aplication;

use App\Contract\ListAllUsersInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AllUsersContoller extends Controller
{
    private ListAllUsersInterface $list;
    public function __construct(ListAllUsersInterface $list)
    {
        $this->list = $list;
    }

    /**
     *
     * @OA\Get(
     *     path="/api/user",
     *     tags={"User"},
     *     @OA\Response(response="200", description="Store successful", @OA\JsonContent()),
     *     @OA\Response(response="413", description="Store failed", @OA\JsonContent()),
     * )
     */
    public function __invoke(Request $request)
    {
        return $this->list->handle();
    }
}
