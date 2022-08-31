<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Contracts\IMLearnService;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MlearnController extends Controller
{

    protected $imlearnService;

    public function __construct
    (
        IMLearnService $imlearnService
    )
    {
        $this->imlearnService = $imlearnService;
    }

    public function upgradeUser($id)
    {

        try{

            $data = $this->imlearnService->upgradeUser($id);
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

    public function downgradeUser($id)
    {
        try{

            $data = $this->imlearnService->downgradeUser($id);
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
