<?php 
// Dada a matriz quadrada, determinar a diferença entre as diagonais principal e secundária:



$m  =       array(array(2, 4, 6, 8),
			array(9, 7, 8, 9), 
			array(3, 5, 8, 7), 
			array(6, 6, 7, 8)); 

		diferencaDiagonais($m, 4);

$MAX = 100; 

function diferencaDiagonais($matriz, $n) 
{ 
	global $MAX; 
	
	$principal = 0; $secundaria = 0; $diferenca = 0; 
	for ($i = 0; $i < $n; $i++) 
	{ 
		$principal += $matriz[$i][$i]; 
		$secundaria += $matriz[$i][$n - $i - 1];
		$diferenca = $principal - $secundaria;
	} 

		
	echo "Diferença das Diagonais:" , 
			$diferenca ,"\n";
	
	
}