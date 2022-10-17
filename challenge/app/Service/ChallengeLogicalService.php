<?php

namespace App\Service;

class ChallengeLogicalService
{
    
    /**
     *
     * @param array $data
     * @param int $dimension
     * 
     * @return array
     * @return bool
     */
	
	public function handle(array $data, int $dimension)
	{
        $diagonalRight = $diagonalLeft = 0;
        
        foreach ($data as $key => $item) {

            if(!isset($item[$key]) || !isset($item[($dimension -1) - $key]))
                return false;
            
            $diagonalLeft += $item[$key];
            $diagonalRight += $item[($dimension -1) - $key];
        
        }

        return [
            'vector' => $data,
            'SumLeft' => $diagonalLeft,
            'SumRight' => $diagonalRight,
            'Result' => $diagonalLeft - $diagonalRight,
        ];
	}    
}