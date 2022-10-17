<?php

namespace App\Http\Controllers;

use App\Service\ChallengeLogicalService;
use Illuminate\Http\Request;

class ChallengeLogicalController extends Controller
{

    /**
     *
     * @var ChallengeLogicalService
     */
    private ChallengeLogicalService $calculateDiffSumm;

    public function __construct(ChallengeLogicalService $calculateDiffSumm)
    {
        $this->calculateDiffSumm = $calculateDiffSumm;
    }

    
    /**
     *
     * @OA\Get(
     *     path="/api/challenge-logical",
     *     description="Retorna a diferença das somas(Result) das diagonais",
     *     tags={"Challeng logical"},
     *     
     *     @OA\Response(response="200", description="Store successful", @OA\JsonContent()),
     *     @OA\Response(response="413", description="Store failed", @OA\JsonContent()),
     * )
     */
    public function __invoke(Request $request)
    {
        $dimension = 3;

        $data = [
            [1, 2, 3],
            [4, 5, 6],
            [9, 8, 9],
        ];
        
        $result = $this->calculateDiffSumm->handle($data, $dimension);

        if(!$result){
            return response()->json([
                'success' => false,
                'message' => 'Verifique os dados e tente novamente mais tarde!',
            ], 403);
        }

        $result['success'] = true;

        return response()->json($result);
    }
}
