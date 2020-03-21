<?php
class MatrizQuadrada{

	function __construct()
	{
		$arrayTotal = array(1,2,3,4,5,6,9,8,9);
		$index = 0;
		$add = 0;
	}
	public function calcular($arrayTotal)
	{
		foreach ($arrayTotal as $key => $value) 
		{
			$var = array_chunk($arrayTotal,3, true);
			$index += 1;
			$matrizQuadrada[$index] = $var[$key];
				
		}
		$val = count($arrayTotal);
		for ($i=0; $i < $val; $i++) 
		{ 
			
			$direitaEsqueda = $matrizQuadrada[1][0]+$matrizQuadrada[2][4]+$matrizQuadrada[3][8]; // PRIMEIRO RESULTADO 
			$esquerdaDireita = $matrizQuadrada[3][6]+$matrizQuadrada[2][4]+$matrizQuadrada[1][2]; // SEGUNDO RESULTADO
		
		}
		
		return $direitaEsqueda - $esquerdaDireita;
		
	}
}

$arrayTotal = array(1,2,3,4,5,6,9,8,9);

$MatrizQuadrada = new MatrizQuadrada();
echo $MatrizQuadrada->calcular($arrayTotal);
// ou var_dump($calculo->calcular($arrayTotal)); para mostrar o tipo;